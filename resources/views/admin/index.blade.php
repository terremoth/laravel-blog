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
                        <td><a href="{{route('post', ['id' => $post->post_id, 'url' => $post->post->url])}}">{{ $post->post->title }}</a></td>
                        <td class="text-center">{{ $post->quantity }}</td>
                        <td class="text-center"><a href="#" role="button" class="btn btn-primary text-white"><i class="fa fa-pencil"></i> Edit</a> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
