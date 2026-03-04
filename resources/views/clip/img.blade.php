@if(!empty($filename))
    <picture>
        <!-- Large screens -->
        <source 
            media="(min-width: 1200px)" 
            srcset="{{ asset('images/uploads/large/'.$filename) }}">

        <!-- Medium screens -->
        <source 
            media="(min-width: 768px)" 
            srcset="{{ asset('images/uploads/medium/'.$filename) }}">

        <!-- Small screens -->
        <source 
            media="(min-width: 576px)" 
            srcset="{{ asset('images/uploads/small/'.$filename) }}">

        <!-- Fallback / very small -->
        <img 
            src="{{ asset('images/uploads/thumb/'.$filename) }}"
            class="img-fluid {{ $class ?? ''}}"
            alt="{{ $alt ?? $filename ?? '' }}"
            width="{{ $width ?? 400 }}"
            height="{{ $height ?? 300 }}"
            loading="lazy"
            >
    </picture>
@else
    <picture>
        <!-- Large screens -->
        <source 
            media="(min-width: 1200px)" 
            srcset="{{ asset('images/uploads/large/no-image.webp') }}">

        <!-- Medium screens -->
        <source 
            media="(min-width: 768px)" 
            srcset="{{ asset('images/uploads/medium/no-image.webp') }}">

        <!-- Small screens -->
        <source 
            media="(min-width: 576px)" 
            srcset="{{ asset('images/uploads/small/no-image.webp') }}">

        <!-- Fallback / very small -->
        <img 
            src="{{ asset('images/uploads/thumb/no-image.webp') }}"
            class="img-fluid {{ $class ?? ''}}"
            alt="{{ $alt ?? $filename ?? '' }}"
            width="{{ $width ?? 400 }}"
            height="{{ $height ?? 300 }}"
            loading="lazy"
            >
    </picture>
@endif