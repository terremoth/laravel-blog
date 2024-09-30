<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Widget;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pages = Page::get();
        $posts = Post::orderBy('id', 'desc')->paginate(6);
        $widgets = Widget::get();
        $tags = Tag::halfTags();
        return view('index', ['pages' => $pages, 'posts' => $posts, 'widgets' => $widgets, 'tags' => $tags]);
    }
}
