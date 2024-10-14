@extends('admin.layouts.dashboard')
@section('content')
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row display-6">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body"><i class="fa-solid fa-file-lines"></i> {{ $postsCount . ' ' . __('Posts')}}</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4">
            <div class="card-body"><i class="fa-solid fa-tags"></i> {{ $tagsCount . ' ' . __('Tags')}}</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body"><i class="fa-solid fa-comments"></i> {{ $commentsCount . ' ' . __('Comments')}}</div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body"><i class="fas fa-users"></i> {{ $usersCount . ' ' . __('Users')}}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Top 10 Most Commented Posts
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped table-bordered" id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>Post</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Controls</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topTenMostCommentedPosts as $post)
                        <tr>
                            <td><a href="{{route('post', ['post' => $post->post_id, 'url' => $post->post->url])}}">{{ $post->post->title }}</a></td>
                            <td class="text-center">{{ $post->quantity }}</td>
                            <td class="text-center">
                                <a href="{{route('admin.posts.edit', ['post' => $post->post_id])}}" role="button" class="btn btn-info text-white">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Comments needing approval
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Comment</th>
                        <th class="text-center">By</th>
                        <th class="text-center">Post</th>
                        <th class="text-center">Controls</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>hello world test</td>
                        <td>Fulano de tal (fulano@gmail.com)</td>
                        <td>Post testing example</td>
                        <td class="text-center">
                            <a role="button" class="btn btn-success" href="#"><i class="fa fa-check"></i></a>
                            <a role="button" class="btn btn-danger" href="#"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Last 10 Posts
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Post</th>
                            <th>By</th>
                            <th class="text-center text-nowrap"># Comments</th>
                            <th class="text-center">Controls</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($lastTenPosts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{ $post->user->name }}</td>
                                <td class="text-center">{{ $post->comments->count() }}</td>
                                <td class="text-nowrap">
                                    <a href="" role="button" class="btn btn-info text-white">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <a role="button" class="btn btn-danger" href="#"><i class="fa fa-times"></i> Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    No posts yet...
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Last 10 Comments
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Comment</th>
                                <th>By</th>
                                <th>Post</th>
                                <th class="text-center">Controls</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lastTenComments as $comment)
                                <tr>
                                    <td>{{ $comment->content }}</td>
                                    <td>{{ $comment->user->name }}</td>
                                    <td>{{ $comment->post->title }}</td>
                                    <td class="text-nowrap">
                                        <a role="button" class="btn btn-danger" href="#"><i class="fa fa-times"></i> Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">
                                        No posts yet...
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
