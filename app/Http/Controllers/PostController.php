<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $url): RedirectResponse | View
    {
        $post = Post::findOrFail($id);

        if ($post->url != $url) {
            return redirect()->route('post', ['id' => $id, 'url' => $post->url]);
        }

        $pages = Page::all();
        $tags = Tag::halfTags();

        return view('posts/show', ['post' => $post, 'pages' => $pages, 'tags' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) : View
    {
        return view('admin/posts/edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {

        if ($post->guard([])->update($request->all())) {
            session()->flash('success_message', 'Record ' . $post->id . ' successfully updated!');
            return redirect()->route('admin.posts.index');
        }

        return redirect()->back()->withErrors(['Unable to update data', 'Database error'])->withInput($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
