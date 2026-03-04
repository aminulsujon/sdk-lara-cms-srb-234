@if(!empty($leads->Contents) && count($leads->Contents) > 0)

<div class="col-md-3">
<div class="mb-4">
    <div class="section-tittle mb-30">
        <h3>
            <a href="{{ url($leads->linkto) }}">
                {{ $leads->title }}  
            </a>
        </h3>
    </div>
    @foreach($leads->Contents->take(1) as $content)
        <div class="single-what-news mb-4">
            <div class="what-img">
                @if(!empty($content['upload']) && count($content['upload']) > 0)
                @foreach ($content['upload'] as $item)
                    <a href="{{ $content['slug'] }}">
                        <img class="img-fluid" src="{{ asset( 'images/uploads/medium/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                    </a>
                    @break
                @endforeach
                @else
                <a href="{{ $content['slug'] }}">
                    <img class="img-fluid" src="{{ asset( 'images/uploads/thumb/'.$websettings['cms_no_image']) }}" alt="No Image">
                </a>
                @endif
            </div>
            <div class="mt-2">
                <h4><a href="{{ $content['slug'] }}">{{ $content['name'] }}</a></h4>
            </div>
        </div>
        
    @endforeach

        @foreach($leads->Contents->skip(1)->take(2) as $content)
                    <div class="mt-2">
                        <a href="{{ $content->slug }}" class="w-100 text-decoration-none d-inline-flex align-items-center @if (!$loop->last) border-bottom pb-2 mb-2 @else pb-4 @endif">
                                <span class="fw-bold">{{ $content->name }}</span>  
                               
                            </a>
                    </div>
                @endforeach
    
</div>
</div>
@endif