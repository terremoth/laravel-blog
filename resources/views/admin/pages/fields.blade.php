@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    @vite(['resources/css/choices-plugin-bootstrap5.2.css'])
@endpush

<div class="row mb-2">
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-8">
        <label class="form-label" for="name">Name:</label>
        {{ html()->text('name')->required()->maxlength(255)->placeholder('Lorem ipsum dolor sit amet...')
            ->autocomplete()->class('form-control') }}
    </div>
    <div class="col-sm-6 col-lg-3 col-xl-2">
        <label class="form-label" for="published">Published:</label>
        {{ html()->select('published', $yesNoOptions)->required()->class('form-select') }}
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <label for="meta_description" class="form-label">Meta Description:</label>
        {{ html()->text('meta_description')->placeholder('The page description')->class('form-control') }}
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <label for="tags" class="form-label">Meta Keywords:</label>
        {{ html()->text('meta_keywords')->placeholder('Comma separated, eg: car,game,action')
            ->class('form-control')->required()->id('tags') }}
    </div>
</div>
<h3 class="mt-4">Featured Image</h3>

<div class="row row-cols-lg-auto g-3 align-items-center mb-3">
    {{--    <div class="col-sm-6">--}}
    <div class="col-12">

        <label class="form-label" for="featured_image_type">
            Choose if the image will be a file or a URL:
        </label>
    </div>
    <div class="col-12">
        {{ html()->select('featured_image_type', $imageOptions)->required()->class('form-select') }}
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <label for="featured_image_path" class="form-label">File:</label>
        {{ html()->file('featured_image_path')->class('form-control') }}
    </div>
    <div class="col-md-6">
        <label for="tags" class="form-label">Or Image URL:</label>
        {{ html()->input('url', 'featured_image_external_url')
            ->placeholder('Complete URL, eg.: https://picsum.photos/200/300')->class('form-control') }}
    </div>

</div>

<div class="row mb-4">
    <div class="col-md-6">
        <label for="tags" class="form-label">Featured Image Alt. Description:</label>
        {{ html()->text('featured_image_alt')
             ->placeholder('Description in case your image does\'t load or for blind people')->class('form-control') }}
    </div>
</div>
<div class="row mb-4">
    @if(isset($page))
        @if ($page->image_path)
            <div class="col-md-4 load-image">
                <img src="{{$page->image_path}}" class="img-thumbnail" alt="{{$page->featured_image_alt}}"/>
            </div>
            <div class="col-md-8 img-btn-delete">
                <a href="{{route('admin.pages.delete-featured-image', ['page' => $page->id, 'token' => csrf_token()])}}"
                   class="btn btn-danger" role="button">
                    <i class="fa fa-times"></i> Remove previous saved image
                </a>
            </div>
        @else
            <div class="col-md-4 load-image"></div>
            <div class="col-md-8 img-btn-delete"></div>
        @endif
    @else
        <div class="col-md-4 load-image"></div>
        <div class="col-md-8 img-btn-delete"></div>
    @endif
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <label for="content" class="form-label">Content:</label>
        {{ html()->textarea('content')->required()->class('form-control')->rows(15)->style('overflow-x: hidden')->id('content') }}
    </div>
</div>
<div class="mb-4">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
</div>

@include('admin.layouts.scripts')

