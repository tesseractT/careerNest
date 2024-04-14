@props(['height', 'width', 'src'])
@if ($src)
    <div>
        <img {{ $attributes->merge(['style' => "height: {$height}px; width: {$width}; object-fit:cover;"]) }}
            src="{{ $src }}" alt="">
    </div>
@endif
