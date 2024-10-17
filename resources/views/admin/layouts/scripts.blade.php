@push('scripts')

    <script type="text/javascript" src="/build/assets/tinymce/tinymce.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    @vite(['resources/js/build_editor.js', 'resources/js/build_choices.js'])

    <script>
        window.addEventListener('DOMContentLoaded', _ => {
            build_editor('textarea#content');
            build_choices('#tags');
        });
    </script>

@endpush

