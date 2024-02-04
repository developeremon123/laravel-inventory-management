<div class="form-group {{ $col ?? '' }}">
    <input type="file" name="{{ $name }}" id="{{ $name }}" class="{{ $class ?? '' }}"
        data-show-errors="true" data-errors-position="outside" data-allowed-file-extensions="jpg jpeg png svg gif webp">
    <input type="hidden" name="old_{{ $name }}" id="old_{{ $name }}">
</div>