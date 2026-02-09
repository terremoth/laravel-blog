@extends('layouts.structure')
@section('content')

<div class="container mt-4">
    <div class="row justify-content-md-center">
        <div class="col-lg-8">
            <article>
                <header class="mb-4">
                    <h1 class="fw-bolder mb-1 text-center">{{$page->name}}</h1>
                </header>
                @if ($page->image_path)
                    <figure class="mb-4 text-center">
                        <img class="img-fluid rounded" src="{{$page->image_path}}" alt="{{$page->featured_image_alt}}"/>
                    </figure>
                @endif
                <section class="mb-5">
                    {!! $page->content !!}
                </section>
            </article>
        </div>
    </div>
</div>

@endsection
