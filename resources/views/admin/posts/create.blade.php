@extends('admin.layouts.dashboard')
@section('content')

    <h1 class="mt-4">Create Post</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Post</li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
    {{ html()->form('POST', route('admin.posts.store'))->open() }}
    @include('admin/posts/fields')
    {{ html()->form()->close() }}
@endsection
