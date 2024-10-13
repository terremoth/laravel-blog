{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css" />--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"/>

<style>
    .choices {
        border-radius: .375rem;
    }

    .choices__inner {
         background-color: white;
    }

    .choices__list--multiple .choices__item {
        font-size: 1rem;
        background-color: #0d6efd;
    }

    .choices__list--dropdown,.choices__list  {
        z-index: 1000!important;
    }


</style>
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

<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

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

    const sanitize_choice_list = (array_options) => {
        return [...new Set( array_options.split(',').map(item => item.trim()).filter(item => item.length > 0))];
    };

    const tags_element = document.getElementById('tags');
    const tags_cleaned = sanitize_choice_list(tags_element.value);
    const tag_parent_element = tags_element.parentElement;
    tags_element.remove();
    let select_choices = document.createElement("select");
    select_choices.multiple = true;
    select_choices.setAttribute('id', 'tags');
    select_choices.classList.add('form-select');
    select_choices.name = 'tags[]';

    tags_cleaned.map(tag => {
        let option = document.createElement("option");
        option.setAttribute('selected', 'selected');
        option.innerHTML = tag;
        option.value = tag;
        select_choices.append(option);
    });

    console.log(tags_element.value);
    tag_parent_element.append(select_choices);


    const element = document.getElementById('tags');

    const choices = new Choices(element, {
        editItems: true,
        addChoices: true,
    });

    choices.setChoices(async () => {
         try {
            const items = await fetch('/tag-list');
            const json = await items.json();
            let arr = [];
            json.forEach(choice => {
                arr.push({
                    value: choice,
                    label: choice
                })
            });
            return arr;
        } catch (err) {
            console.error(err);
        }
    });



</script>
