@extends('admin.layouts.dashboard')
@section('content')

    <h1 class="mt-4">Edit Post {{$post->id}}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    {{ html()->modelForm($post, 'PATCH', route('admin.posts.update', ['post' => $post->id]))->open() }}
    @include('admin/posts/fields')
    {{ html()->closeModelForm() }}
@endsection
