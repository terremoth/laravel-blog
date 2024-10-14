<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        $tagsCount = Tag::distinct()->get(['name'])->count();
        $usersCount = User::count();

        $lastTenPosts = Post::select('id', 'title', 'user_id')->orderBy('id', 'desc')->limit(10)->get();
        $lastTenComments = Comment::select('content', 'post_id', 'user_id')->orderBy('id', 'desc')->limit(10)->get();

        // select post_id, count(post_id) as quantity from comments group by post_id order by quantity desc limit 10 ;
        $topTenMostCommentedPosts = Comment::select('post_id', DB::raw('count(post_id) as quantity'))
            ->groupBy('post_id')
            ->orderBy('quantity', 'desc')
            ->limit(10)
            ->get();

//        dd($topTenMostCommentedPosts);

        return view('admin/index', [
            'postsCount' => $postsCount,
            'commentsCount' => $commentsCount,
            'tagsCount' => $tagsCount,
            'usersCount' => $usersCount,
            'topTenMostCommentedPosts' => $topTenMostCommentedPosts,
            'lastTenPosts' => $lastTenPosts,
            'lastTenComments' => $lastTenComments
        ]);
    }
}
