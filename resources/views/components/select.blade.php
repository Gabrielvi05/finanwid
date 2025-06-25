@props(['id', 'name', 'label', 'options', 'selected' => null])

<div>
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select id="{{ $id }}" name="{{ $name }}" class="form-select">
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ ($selected !== null && $selected == $value) ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>
