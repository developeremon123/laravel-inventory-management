<div class="form-group {{ $col ?? '' }} {{ $required ?? '' }}">
    <label for="{{ $name }}">{{ $labelName }}</label>
    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value ?? '' }}"
    @if (!empty($onkeyup)) onkeyup="{{ $onkeyup ?? '' }}" @endif
        class="form-control {{ $class ?? '' }}" placeholder="{{ $placeholder ?? '' }}">
</div>
