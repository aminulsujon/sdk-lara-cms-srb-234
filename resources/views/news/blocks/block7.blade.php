@if(!empty($leads->Contents) && count($leads->Contents) > 0)
<div class="container mb-5 fade-in">

    {{-- Section Heading --}}
    <div class="row mb-3">
        <div class="col-lg-12 text-center">
            <h3 class="fw-bold mb-2">
                <a href="{{ url($leads->linkto) }}" class="text-dark text-decoration-none">
                    {{ $leads->title }}
                </a>
            </h3>
            <div class="divider mx-auto mb-3" style="width: 80px; height: 3px; background:#007bff;"></div>
        </div>
    </div>

    <div class="row g-4">

        
        {{-- MIDDLE LIST NEWS (4 items) --}}
        <div class="col-md-4 border-start fade-in">
            @foreach($leads->Contents->skip(1)->take(4) as $content)
                <div class="d-flex align-items-center justify-content-between py-2 border-bottom hover-zoom">
                    <a href="{{ $content->slug }}" class="text-dark fw-semibold text-decoration-none w-75">
                        {{ $content->name }}
                    </a>
                
                    @if(!empty($content['upload']) && count($content['upload']) > 0)
                        @foreach ($content['upload']->take(1) as $item)
                            <img class="rounded" width="100"
                                 src="{{ asset('images/uploads/thumb/'.$item['file']) }}" 
                                 alt="{{ $item['name'] }}">
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>

        {{-- LEFT LARGE NEWS BLOCK (1 item) --}}
        <div class="col-md-4 fade-in">
            <div class="news-box p-3 hover-zoom">
                @foreach($leads->Contents->take(1) as $content)
                    <a href="{{ $content['slug'] }}" class="text-decoration-none">
                        @if(!empty($content['upload']) && count($content['upload']) > 0)
                            @foreach ($content['upload'] as $item)
                                <img class="img-fluid rounded" 
                                     src="{{ asset('images/uploads/large/'.$item['file']) }}" 
                                     alt="{{ $item['name'] }}">
                                @break
                            @endforeach
                        @else
                            <img class="img-fluid rounded" 
                                 src="{{ asset('images/uploads/thumb/'.$websettings['cms_no_image']) }}" 
                                 alt="No Image">
                        @endif
                    </a>

                    <h4 class="mt-3 fw-semibold">
                        <a href="{{ $content['slug'] }}" class="text-dark">{{ $content['name'] }}</a>
                    </h4>
                @endforeach
            </div>
        </div>


        {{-- RIGHT SIDEBAR (1 item + ad) --}}
        <div class="col-md-4 border-start fade-in">
            
            {{-- Single Highlighted Content --}}
            @foreach($leads->Contents->skip(5)->take(4) as $content)
                <div class="d-flex align-items-center justify-content-between py-2 border-bottom hover-zoom">
                    
                
                    @if(!empty($content['upload']) && count($content['upload']) > 0)
                        @foreach ($content['upload']->take(1) as $item)
                            <img class="rounded" width="100"
                                 src="{{ asset('images/uploads/thumb/'.$item['file']) }}" 
                                 alt="{{ $item['name'] }}">
                        @endforeach
                    @endif
                    <a href="{{ $content->slug }}" class="pl-4 text-dark fw-semibold text-decoration-none w-75">
                        {{ $content->name }}
                    </a>
                </div>
            @endforeach

            
        </div>

    </div>

    <div class="fade-in mt-4">
        @include($websettings['cms_layout'].'.ads.middlecategory')
    </div>
</div>

<style>
/* Fade-in animation */
.fade-in {
    opacity: 0;
    animation: fadeIn 0.8s forwards ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Image hover zoom */
.hover-zoom img {
    transition: transform 0.4s ease;
}
.hover-zoom img:hover {
    transform: scale(1.08);
}

/* card-like container */
.news-box {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    transition: transform .3s;
}
.news-box:hover {
    transform: translateY(-4px);
}
    </style>
@endif
