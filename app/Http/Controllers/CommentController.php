<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
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
    public function store(StoreCommentRequest $request, Post $post, Comment $comment): RedirectResponse
    {
        if (session('captcha_phrase', false) != $request->post('captcha')) {
            return back()->withErrors(['Wrong captcha'])->withFragment('#comment-area');
        }

        $comment->user_id = auth()->id();
        $comment->content = $request->post('content');
        $comment->post_id = $post->id;

        if (!$comment->save()) {
            return back()->withErrors(['Unable to save data'])->withFragment('#comment-area');
        }

        session()->flash('success_message', 'Comment published!');
        return back()->withFragment('#comment-area');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
