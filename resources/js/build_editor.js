function build_editor(selector) {
    tinymce.init({
        selector: selector,
        min_height: screen.height > 850 ? 510 : 310,
        license_key: 'gpl',
        toolbar_mode: 'wrap',
        promotion: false,
        resize: true,
        plugins: `autoresize codeeditor autosave accordion advlist anchor autolink autoresize autolink autosave charmap
                codesample directionality emoticons fullscreen help image importcss insertdatetime link lists format
                media nonbreaking pagebreak preview quickbars save searchreplace table visualblocks visualchars wordcount`,

        toolbar: [
            `help | restoredraft | undo redo | newdocument cancel selectall print codeeditor fullscreen preview
                searchreplace wordcount | copy cut paste pastetext remove save | visualblocks visualchars | visualaid`,

            `blocks fontfamily fontsize | blockquote bold italic underline strikethrough subscript superscript blockquote
                forecolor backcolor | ltr rtl removeformat | styles`,

            `indent outdent lineheight aidialog aishortcuts aligncenter alignjustify alignleft alignnone
                alignright | quicklink link bullist numlist mergetags_list quicktable table tableclass tablecellclass |
                tableofcontents tableofcontentsupdate advtablerownumbering charmap quickimage image imageoptions
                editimage media accordion emoticons anchor insertdatetime hr nonbreaking pagebreak codesample`,
        ]
    });

}

window.build_editor = build_editor;
