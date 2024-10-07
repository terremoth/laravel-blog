@extends('admin.layouts.dashboard')
@section('content')

    <h1 class="mt-4">Posts</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">All</li>
    </ol>
    <div class="row">
        <div>
            <a role="button" class="btn btn-primary"><i class="fa fa-plus"></i> Create</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Title</th>
                        <th>By</th>
                        <th># Comments</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($posts->count())
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id  }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->comments->count() }}</td>
                                <td>
                                    {{ html()->modelForm($post, 'DELETE', route('admin.posts.destroy', ['post' => $post->id]))->class('d-inline')->open() }}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                    {{ html()->closeModelForm() }}
                                    <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-info text-white"><i class="fa fa-pencil"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">No registers found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
@endsection
