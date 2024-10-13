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
    <label for="content" class="form-label">Content:</label>
    <div class="col-md-12">
        {{ html()->textarea('content')->class('form-control')->rows(15)->style('overflow-x: hidden')->id('content') }}
    </div>
</div>
<div class="mb-4">
    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
</div>

<script type="text/javascript" src="/build/assets/tinymce/tinymce.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#content',
        min_height: screen.height > 850 ? 510 : 310,
        license_key: 'gpl',
        toolbar_mode: 'wrap',
        promotion: false,
        resize: true,
        plugins: `autoresize codeeditor autosave accordion advlist anchor autolink autoresize autolink autosave charmap
            codesample directionality emoticons fullscreen help image importcss insertdatetime link lists
            media nonbreaking pagebreak preview quickbars save searchreplace table visualblocks visualchars wordcount`,

        toolbar: [
            `help | restoredraft | undo redo | newdocument cancel selectall print codeeditor fullscreen preview
            searchreplace wordcount | copy cut paste pastetext remove save | visualblocks visualchars | visualaid`,

            `blocks fontfamily fontsize | bold italic underline strikethrough subscript superscript blockquote
            forecolor backcolor | ltr rtl removeformat | styles`,

            `indent outdent lineheight aidialog aishortcuts aligncenter alignjustify alignleft alignnone
            alignright | quicklink link bullist numlist mergetags_list quicktable table tableclass tablecellclass |
            tableofcontents tableofcontentsupdate advtablerownumbering charmap quickimage image imageoptions
            editimage media accordion emoticons anchor insertdatetime hr nonbreaking pagebreak codesample`,
        ]
    });
</script>
