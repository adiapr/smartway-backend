@props([
        'name',
        'id' => $name,
        'type' => 'text',
        'class',
        'label',
        'required' => false,
        'placeholder',
        'attribute' => '',
        'value',
        'rows' => 3, 
        'cols' => 1,
        'editor' => ''
    ])
<div class="form-group mt-3">
    @if ($label)
        <label for="{{ $id }}" class="form-label fw-bold">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <textarea 
        class="{{ @$class ?: 'form-control' }}  @error($name) is-invalid @enderror" 
        name="{{ $name }}" 
        id="editor{{ $editor }}"
        {{-- id="editor1"  --}}
        placeholder="{{ @$placeholder }}" 
        rows="{{ $rows }}" 
        cols="{{ $cols }}"
        {{ @$attribute }}
    >
        {{ old($name, @$value) }}</textarea>
    @error($name)
        <span class="invalid-feedback">
          {{ $message }}
        </span>
    @enderror

    {{-- @include('plugin.ckeditor5-classic') --}}
    {{-- @include('partials.ckeditor5') --}}
</div>