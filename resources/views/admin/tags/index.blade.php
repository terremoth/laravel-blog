@extends('admin.layouts.dashboard')
@section('content')

    <h1 class="mt-4">Tags</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">All</li>
    </ol>

    <div class="row mt-4">
        <div class="col-12 table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center">Posts using</th>
                    <th class="text-center">Controls</th>
                </tr>
                </thead>
                <tbody>
                @if ($tags->count())
                    @foreach($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td class="text-center">
                                <a target="_blank" href="{{route('tag', ['name' => $tag->name])}}">
                                    {{$tag->quantity}}<i class="fa fa-external-link fa-xs"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                {{ html()->modelForm($tag, 'DELETE', route('admin.tags.destroy', ['tag' => urlencode($tag->name)]))->class('d-inline')->open() }}
                                <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Delete</button>
                                {{ html()->closeModelForm() }}
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
            {{ $tags->links() }}
        </div>
    </div>
@endsection
