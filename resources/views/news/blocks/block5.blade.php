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
                @foreach($leads->Contents->take(1) as $content)
                    <div class="col-12">
                        <div class="single-what-news">
                            <div class="what-img">
                                @if(!empty($content['upload']) && count($content['upload']) > 0)
                                @foreach ($content['upload'] as $item)
                                    <a href="{{ $content['slug'] }}">
                                        @if($loop->iteration == 1) 
                                        <img class="img-fluid" src="{{ asset( 'images/uploads/small/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                        @else 
                                        <img class="img-fluid" src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                        @endif
                                        
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
                @foreach($leads->Contents->skip(1)->take(3) as $content)
                    <div class="col-12">
                        <a href="{{ $content->slug }}" class="w-100 text-decoration-none d-inline-flex justify-content-center align-items-center @if (!$loop->last) border-bottom pb-2 mb-2 @else pb-4 @endif">
                            <span class="fw-bold">{{ $content->name }}</span>  
                            @if(!empty($content['upload']) && count($content['upload']) > 0)
                                @foreach ($content['upload']->take(1) as $item)
                                    <img 
                                        class="rounded w-50 ml-4"
                                            src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}"
                                            alt="{{ $item['name'] }}"
                                        >
                                @endforeach
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 border-left">
            
            <div class="row mb-4">
                @foreach($leads->Contents->skip(4)->take(2) as $content)
                    <div class="col-12">
                        <a href="{{ $content->slug }}" class="w-100 text-decoration-none d-inline-flex justify-content-center align-items-center @if (!$loop->last) border-bottom pb-2 mb-2 @else pb-2 @endif">
                                <span class="fw-bold">{{ $content->name }}</span>  
                                @if(!empty($content['upload']) && count($content['upload']) > 0)
                                    @foreach ($content['upload']->take(1) as $item)
                                        <img 
                                            class="rounded w-50 ml-4"
                                                src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}"
                                                alt="{{ $item['name'] }}"
                                            >
                                    @endforeach
                                @endif
                            </a>
                    </div>
                @endforeach
            </div>
            
            @include($websettings['cms_layout'].'.ads.320x100',['height'=>'100','width'=>'300','position'=>'promo','class'=>'mb-2']) 
        </div>
    </div>
    @include($websettings['cms_layout'].'.ads.middlecategory') 
</div>
<style>
    .txt-cx {
        font-size: 18px;
        font-weight: 600;
        margin-left: 8px;
        color: #dd3633;
    }
</style>
@endif