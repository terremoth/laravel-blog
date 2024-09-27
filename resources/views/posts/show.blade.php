<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Blog Post - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    @vite(['resources/css/styles.css', 'resources/js/scripts.js'])
</head>
<body>
<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
            </ul>
        </div>
    </div>
</nav>
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
                        {{$post->content}}
                    </p>
                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <!-- Comment form-->
                        <form class="mb-4">
                            <textarea class="form-control" required rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                            <button class="btn btn-primary mt-3">Comment</button>
                        </form>
                        <!-- Comment with nested comments-->
                        <hr>
                            <!-- Parent comment-->
                                @foreach($post->comments as $comment)
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
                        <div class="d-flex">
                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                            <div class="ms-3">
                                <div class="fw-bold">Commenter Name</div>
                                When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
</body>
</html>
