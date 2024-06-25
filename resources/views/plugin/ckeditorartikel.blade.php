@push('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
            max-height: 450px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
@endpush
@push('scripts')
<script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor1' ), {
            // toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload', 'table', 'TableToolbar'],
            ckfinder: {
                uploadUrl: '{{ route("upload") }}?_token={{ csrf_token() }}',
                options: {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }
            }
        })
        .catch( error => {
            console.error( error );
        } );
</script>
@endpush
