@extends('admin.layouts.dashboard')
@section('content')

    <h1 class="mt-4">Page {{$page->id}}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Page</li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    {{ html()->modelForm($page, 'PATCH', route('admin.pages.update', ['page' => $page->id]))
        ->id('form-pages-update')
        ->name('form-pages-update')
        ->open() }}
    @include('admin/pages/fields')
    {{ html()->closeModelForm() }}
@endsection

@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', async _ => {
            load_image_from_file_input('#featured_image_path', '.load-image');
        });
    </script>
@endpush
