@if(!empty($leads->Contents) && count($leads->Contents) > 0)
<div class="container mb-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="whats-news-caption">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle mb-30">
                            <h3>
                                <a href="{{ url($leads->linkto) }}">
                                    {{ $leads->title }}  
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-md-4">
           
            <div class="row">
                @foreach($leads->Contents->take(4) as $content)
                    <div class="col-12">
                        <a href="{{ $content->slug }}" class="w-100 text-decoration-none d-inline-flex justify-content-center align-items-center @if (!$loop->last) border-bottom pb-2 mb-2 @else pb-4 @endif">
                                @if(!empty($content['upload']) && count($content['upload']) > 0)
                                    @foreach ($content['upload']->take(1) as $item)
                                        <img 
                                            class="rounded ml-4"
                                                src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}"
                                                alt="{{ $item['name'] }}"
                                                width="80"
                                            >
                                    @endforeach
                                @endif
                            <span class="fw-bold pl-4">{{ $content->name }}</span>  
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4 border-left">
            <div class="row">
                @foreach($leads->Contents->skip(4)->take(1) as $content)
                    <div class="@if($loop->iteration == 1) col-12 @else col-6 @endif">
                        <div class="single-what-news mb-4">
                            <div class="what-img">
                                @if(!empty($content['upload']) && count($content['upload']) > 0)
                                @foreach ($content['upload'] as $item)
                                    <a href="{{ $content['slug'] }}">
                                        <img class="img-fluid" src="{{ asset( 'images/uploads/large/'.$item['file']) }}" alt="{{ $item['name'] }}">  
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
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4 border-left">
            <div class="row">
                @foreach($leads->Contents->skip(5)->take(4) as $content)
                    <div class="col-12">
                        <a href="{{ $content->slug }}" class="w-100 text-decoration-none d-inline-flex justify-content-center align-items-center @if (!$loop->last) border-bottom pb-2 mb-2 @else pb-4 @endif">
                                
                            <span class="fw-bold">{{ $content->name }}</span>  
                            @if(!empty($content['upload']) && count($content['upload']) > 0)
                                    @foreach ($content['upload']->take(1) as $item)
                                        <img 
                                            class="rounded ml-4"
                                                src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}"
                                                alt="{{ $item['name'] }}"
                                                width="80"
                                            >
                                    @endforeach
                                @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include($websettings['cms_layout'].'.ads.middlecategory') 
</div>
@endif