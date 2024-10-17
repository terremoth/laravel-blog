@extends('admin.layouts.dashboard')
@section('content')

    <h1 class="mt-4">Pages</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">All</li>
    </ol>

    <div class="row mt-4">
        <div class="col-12 table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center">Published</th>
                    <th>Keywords</th>
                    <th>Controls</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $page->name }}</td>
                            <td class="text-center">
                                <i class="fa fa-2x enabled-icon-{{$page->published}}"></i>
                            </td>
                            <td>{{ $page->meta_keywords }}</td>
                            <td>
                                <a href="{{ route('admin.pages.edit', ['page' => $page->id]) }}" class="btn btn-info text-white"><i class="fa fa-pencil"></i> Edit</a>
                                {{ html()->modelForm($page, 'DELETE', route('admin.pages.destroy', ['page' => $page->id]))->class('d-inline')->open() }}
                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                {{ html()->closeModelForm() }}
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="10">No registers found</td>
                            </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $pages->links() }}
        </div>
    </div>
@endsection
