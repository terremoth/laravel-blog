<div class="row">
    <div class="col-md-6">
        <label class="form-label" for="title">Title:</label>
        {{ html()->input('text', 'title')->required()->maxlength(255)->class('form-control') }}
    </div>
    <div class="col-md-6">
        <label class="form-label" for="title">Enable comments:</label>
        {{ html()->select('enable_comments', ['1' => 'Yes', '0' => 'No'])->required()->class('form-select') }}
    </div>
</div>
<div class="row">
    <label for="content" class="form-label">Content:</label>
    {{ html()->textarea('content')->class('form-control')->rows(15)->style('overflow-x: hidden') }}
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>


<script>
    window.addEventListener('DOMContentLoaded', _ => {
        ClassicEditor
            .create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });

    })
</script>
