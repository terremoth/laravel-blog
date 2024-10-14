@extends('layouts.structure')

@push('css')
@vite(['resources/css/captcha-audio.css'])
@endpush

@section('content')

<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{$post->title}}</h1>
                    <!-- Post meta content-->
                    <time itemprop="dateCreated" title="{{ $post->created_at->format('r')}}" datetime="{{$post->created_at->format('c')}}" class="small text-muted fst-italic mb-2">{{ $post->created_at->format('r') }}</time>

                    <span class="text-muted fst-italic mb-2">by {{$post->user->name}}</span>
                    <!-- Post categories-->
                    <div class="d-block mt-2">
                        @foreach($post->tags as $tag)
                            <a class="badge bg-secondary text-decoration-none link-light" href="#">{{$tag->name}}</a>
                        @endforeach
                    </div>
                </header>
                <!-- Preview image figure-->
                @if ($post->featured_image_path)
                    <figure class="mb-4">
                        <img class="img-fluid rounded" src="{{$post->featured_image_path}}" alt="{{$post->featured_image_alt}}" />
                    </figure>
                @endif
                <!-- Post content-->
                <section class="mb-5">
                    <p>
                        {!!  $post->content !!}
                    </p>
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body" id="comment-area">
                        <!-- Comment form-->
                        @auth
                            {{ html()->form('POST', route('comment.store', ['post' => $post->id]))->open() }}
                                <textarea maxlength="1024" name="content" class="form-control" required rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                                <div class="input-group mt-3">
                                    <img src="{{$captcha->inline()}}" alt="captcha image" title="captcha image">
                                    <a class="btn btn-default" title="Refresh Captcha" target="_top"
                                       href="{{route('captcha.refresh') }}">
                                        <i class="fa fa-xl fa-rotate-right align-bottom"></i>
                                    </a>
                                    <audio title="Listen the captcha characters" class="captcha-audio" controls src="{{ route('captcha-audio', ['token' => csrf_token()]) }}"></audio>
                                    <input placeholder="Type the corresponding captcha text" type="text" autocomplete="off" name="captcha" value="" required class="form-control">
                                </div>
                                <div class="row mt-3">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3"><i class="fa fa-comment-dots"></i> Comment</button>
                            {{ html()->form()->close() }}
                        @endauth
                        @guest
                            <form>
                                <textarea name="content" disabled class="form-control" required rows="3" placeholder="You need to be a user and login to comment"></textarea>
                                <div class="">
                                    <button type="button" disabled class="btn btn-primary mt-3 align-middle"><i class="fa fa-lock"></i> Comment</button>
                                    <a class="d-inline-block mt-2 ml-4" href="">Create Account</a>
                                </div>
                            </form>
                        @endguest

                        <!-- Comment with nested comments-->
                        <hr>
                        @if (session()->has('success_message'))
                            <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">
                                <i class="fa fa-check"></i> {{ session('success_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert">
                                <h5 class="alert-heading">@lang('The following errors have occurred:')</h5>
                                <ul class="list">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                            <!-- Parent comment-->
                        @if (!count($comments))
                            <span>No comments yet</span>
                        @endif
                                @foreach($comments as $comment)
                            <div class="d-flex mb-4">
                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">{{$comment->user->name}}</div>
                                        {{ $comment->content }}
                                    <!-- Child comment 1-->
{{--                                        <div class="d-flex mt-4">--}}
{{--                                            <div class="flex-shrink-0">--}}
{{--                                                <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>--}}
{{--                                            <div class="ms-3">--}}
{{--                                                <div class="fw-bold">Commenter Name</div>--}}
{{--                                                And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- Child comment 2-->--}}
{{--                                        <div class="d-flex mt-4">--}}
{{--                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>--}}
{{--                                            <div class="ms-3">--}}
{{--                                                <div class="fw-bold">Commenter Name</div>--}}
{{--                                                When you put money directly to a problem, it makes a good headline.--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                </div>
                            </div>
                        @endforeach

                        <!-- Single comment-->
{{--                        <div class="d-flex">--}}
{{--                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>--}}
{{--                            <div class="ms-3">--}}
{{--                                <div class="fw-bold">Commenter Name</div>--}}
{{--                                When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </section>
        </div>
        @include('widgets')
    </div>
</div>

@endsection
