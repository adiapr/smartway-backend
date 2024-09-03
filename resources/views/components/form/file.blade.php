@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/dropify/css/dropify.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('plugins/dropify/js/upload-init.js') }}"></script>
@endpush

<input type="file"
    name="cover"
    class="dropify"
    data-max-file-size="1M"
    required
    style="border: dahed 2px gray"
    data-default-file="{{ $method == 'put' ? $data->cover_url : asset('img/thumbnail/default.jpg') }}">
@error('cover')
    <div class="invalid-feedback d-block">
        {{ $message }}
    </div>
@enderror