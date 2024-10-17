@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>
    @vite(['resources/css/choices-plugin-bootstrap5.2.css'])
@endpush

<div class="row mb-2">
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-8">
        <label class="form-label" for="title">Title:</label>
        {{ html()->input('text', 'title')->required()->maxlength(255)->placeholder('Lorem ipsum dolor sit amet...')->class('form-control') }}
    </div>
    <div class="col-sm-6 col-lg-3 col-xl-2">
        <label class="form-label" for="title">Enable comments:</label>
        {{ html()->select('enable_comments', ['1' => 'Yes', '0' => 'No'])->required()->class('form-select') }}
    </div>
</div>

<div class="row mb-4">
    <div class="col-12">
        <label for="tags" class="form-label">Tags:</label>
        {{ html()->input('text', 'tags', $tags ?? null)->placeholder('Comma separated, eg: car,game,action')->class('form-control') }}
    </div>
</div>

<div class="row mb-4">
    <label for="content" class="form-label">Content:</label>
    <div class="col-md-12">
        {{ html()->textarea('content')->class('form-control')->rows(15)->style('overflow-x: hidden')->id('content') }}
    </div>
</div>
<div class="mb-4">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
</div>

@include('admin.layouts.scripts')
@push('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', _ => {
            addTagsChoicesFromAjax();
        });
    </script>
@endpush
