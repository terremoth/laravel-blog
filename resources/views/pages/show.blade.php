@extends('layouts.structure')
@section('content')

<!-- Page content-->
<div class="container mt-5">
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1 text-center">{{$page->name}}</h1>
                    <!-- Post meta content-->
{{--                    <time itemprop="dateCreated" title="{{ $page->created_at->format('r')}}" datetime="{{$page->created_at->format('c')}}" class="small text-muted fst-italic mb-2">{{ $page->created_at->format('r') }}</time>--}}

{{--                    <span class="text-muted fst-italic mb-2">by {{$page->user->name}}</span>--}}
                    <!-- Post categories-->
                    <div class="d-block mt-2">
{{--                        @foreach($page->tags as $tag)--}}
{{--                            <a class="badge bg-secondary text-decoration-none link-light" href="#">{{$tag->name}}</a>--}}
{{--                        @endforeach--}}
                    </div>
                </header>
                <!-- Preview image figure-->
                @if ($page->featured_image_path)
                    <figure class="mb-4 text-center">
                        <img class="img-fluid rounded" src="{{$page->featured_image_path}}" alt="{{$page->featured_image_alt}}" />
                    </figure>
                @endif
                <!-- Post content-->
                <section class="mb-5">
                    <p>
                        {{$page->content}}
                    </p>
                </section>
            </article>
            <!-- Comments section-->
        </div>
{{--        @include('widgets')--}}
    </div>
</div>

@endsection
