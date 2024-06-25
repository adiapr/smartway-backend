@props([
        'name',
        'id' => $name,
        'attribute' => '',
        'class',
        'label',
        'required' => false,
    ])

<div class="form-group mt-3">
    @if (@$label)
        <label for="{{ $id }}" class="form-label fw-bold">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <select name="{{ $name }}" id="{{ $id }}" class="{{ @$class ?: 'form-select' }} @error($name) is-invalid @enderror" {{ $required ? 'required' : '' }} {{ $attribute }}>
       {{ $slot }}
    </select>
</div>
@error($name)
    <span class="invalid-feedback">{{ $message }}</span>
@enderror
