@push('styles')
    <style>
        .ck-editor__editable[role="textbox"] {
            min-height: 200px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('plugins/ckeditor5-4/build/ckeditor.js') }}"></script> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.ckeditor5').forEach((editorElement) => {
                ClassicEditor.create(editorElement, {
                    simpleUpload: {
                        // The URL that the images are uploaded to.
                        uploadUrl: "{{ route('admin.upload-file-ckeditor', ['_token' => csrf_token()]) }}",
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
            });
        });
    </script>
@endpush

