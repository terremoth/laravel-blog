<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Tag;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Gregwar\Captcha\CaptchaBuilder;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = Post::orderBy('id', 'desc')->limit(10)->paginate();
        return view('admin/posts/index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Post $post): RedirectResponse
    {
        $post->title = $request->post('title');
        $post->content = $request->post('content');
        $post->enable_comments = $request->post('enable_comments');
        $post->user_id = auth()->id();
        $post->url = Str::slug($post->title);
        $saved = $post->save();

        $tags = $request->post('tags');
        $tags = is_array($tags) ? implode(',', $tags) : $tags;

        if ($tags) {
            $tagsTrimmedUnique = Tag::uniqueTrimmedTags($tags);
            Tag::massSave($tagsTrimmedUnique, $post);
        }

        if ($saved) {
            session()->flash('success_message', 'Record ' . $post->id . ' successfully saved!');
            return redirect()->route('admin.posts.index');
        }

        return redirect()->back()->withErrors(['Unable to save data'])->withInput($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, $url): View|RedirectResponse
    {
        session()->forget('captcha_phrase');

        if ($post->url != $url) {
            return redirect()->route('post', ['id' => $post->id, 'url' => $post->url]);
        }

        $pages = Page::all();
        $tags = Tag::halfTags();
        $comments = $post->comments()->orderBy('id', 'desc')->get();

        $phraseBuilder = new PhraseBuilder(mt_rand(5,7), '0123456789abcdefghijklmnopqrstuvwxyz');
        $builder = new CaptchaBuilder(null, $phraseBuilder);
//        $builder->setMaxBehindLines(0);
//        $builder->setDistortion(false);
        $builder->build();

        session(['captcha_phrase' => $builder->getPhrase()]);

        return view('posts/show', ['post' => $post, 'pages' => $pages, 'tags' => $tags, 'comments' => $comments, 'captcha' => $builder]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) : View
    {
        return view('admin/posts/edit', ['post' => $post, 'tags' => $post->tagsAsStringTogether()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $tags = $request->post('tags');
        $tags = is_array($tags) ? implode(',', $tags) : $tags;

        if ($tags) {
            $tagsTrimmedUnique = Tag::uniqueTrimmedTags($tags);
            $oldPostTags = collect($post->tags()->select(['name', 'post_id'])->get()->map(fn($model) => $model->name));
            $diffNewToOld = $tagsTrimmedUnique->diff($oldPostTags);
            $diffOldToNew = $oldPostTags->diff($tagsTrimmedUnique);

            if (count($diffNewToOld->all()) > 0 || $diffOldToNew->all() > 0) {
                $post->tags()->delete();
                Tag::massSave($tagsTrimmedUnique, $post);
            }
        } else {
            $post->tags()->delete();
        }

        if ($post->guard([])->update($request->except('tags'))) {
            session()->flash('success_message', 'Post ' . $post->id . ' successfully updated!');
            return redirect()->route('admin.posts.index');
        }

        return redirect()->back()->withErrors(['Unable to update data'])->withInput($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) : RedirectResponse
    {
        $deleted = $post->delete();
        if ($deleted) {
            session()->flash('success_message', 'Post ' . $post->id . ' successfully removed!');
            return redirect()->route('admin.posts.index');
        }

        return redirect()->back()->withErrors(['Unable to delete data']);
    }
}
