@props([
        'name',
        'id' => $name,
        'type' => 'text',
        'class',
        'placeholder',
        'attribute' => '',
        'value',
        'label',
        'required' => false,
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
    <input type="{{ $type }}" class="{{ @$class ?: 'form-control' }}  @error($name) mt-1 is-invalid @enderror" name="{{ $name }}" id="{{ $id }}" value="{{ old($name, @$value) }}" placeholder="{{ @$placeholder }}" {{ $required ? 'required' : '' }} {{ @$attribute }}>
    @error($name)
        <span class="invalid-feedback">
        {{ $message }}
        </span>
    @enderror
</div>