@extends('layouts.structure')
@section('content')

<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">January 1, 2023</div>
                    <h2 class="card-title">Featured Post Title</h2>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
                    <a class="btn btn-primary" href="#!">Read more →</a>
                </div>
            </div>
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                    <!-- Blog post-->
                @foreach ($posts as $post)
                <div class="col-lg-6">
                    <div class="card mb-4">
                        @if ($post->featured_image_path)
                            <a href="#!"><img class="card-img-top" src="{{$post->featured_image_path}}"  {{$post->featured_image_alt ?? 'alt="'.$post->featured_image_alt.'"'}} /></a>
                        @endif
                            <div class="card-body">
                                <time itemprop="dateCreated" title="{{ $post->created_at->format('r')}}" datetime="{{$post->created_at->format('c')}}" class="small text-muted">{{ $post->created_at->format('r') }}</time>
                                <h2 class="card-title h4">{{ $post->title }}</h2>
                                <div class="small text-muted mb-2">by {{$post->user->name}}</div>
                                <p class="card-text">{{ substr($post->content,0, 255) }}</p>
                                <a class="btn btn-primary" href="{{ route('post', [$post->id, $post->url]) }}">Read more →</a>
                            </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Pagination-->
            {{ $posts->onEachSide(2)->links() }}
{{--            <nav aria-label="Pagination">--}}
{{--                <hr class="my-0" />--}}
{{--                <ul class="pagination justify-content-center my-4">--}}
{{--                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>--}}
{{--                    <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>--}}
{{--                    <li class="page-item"><a class="page-link" href="#!">2</a></li>--}}
{{--                    <li class="page-item"><a class="page-link" href="#!">3</a></li>--}}
{{--                    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>--}}
{{--                    <li class="page-item"><a class="page-link" href="#!">15</a></li>--}}
{{--                    <li class="page-item"><a class="page-link" href="#!">Older</a></li>--}}
{{--                </ul>--}}
{{--            </nav>--}}
        </div>
        @include('widgets')
    </div>
</div>


@endsection
