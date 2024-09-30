<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\User;
use App\Models\Widget;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        $posts = Post::select('tags.name')
            ->select('posts.*')
            ->join('tags', 'tags.post_id', '=', 'posts.id')
            ->where('tags.name', '=', $name)
//            ->join('users', 'posts.user_id', '=', 'users.id')
            ->paginate(7);

//        dd($posts);

        $pages = Page::get();
        $widgets = Widget::get();
        $tags = Tag::halfTags();
        return view('index', ['pages' => $pages, 'posts' => $posts, 'widgets' => $widgets, 'tags' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
