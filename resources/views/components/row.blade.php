@php
    $rows = [10, 50, 100, 500];
@endphp
<select name="row" class="form-select custom-select" onchange="this.form.submit()">
    @foreach ($rows as $row)
        <option value="{{ $row }}" {{ @$_GET['row'] == $row ? 'selected' : '' }}>
            {{ $row }}</option>
    @endforeach
</select>   