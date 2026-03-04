@if(!empty($leads->Contents) && count($leads->Contents) > 0)
<div class="pl-4 border-left mb-4">
    <div class="section-tittle mb-30">
                            <h3>
                                <a href="{{ url($leads->linkto) }}">
                                    {{ $leads->title }}  
                                </a>
                            </h3>
                        </div>
    <div class="row">
        @foreach($leads->Contents->take(4) as $content)
                    
            @if($loop->iteration==1)
                <div class="col-12 single-what-news mb-4">
                    <div class="what-img">
                        @if(!empty($content['upload']) && count($content['upload']) > 0)
                        @foreach ($content['upload'] as $item)
                            <a href="{{ $content['slug'] }}">
                                <img class="img-fluid" src="{{ asset( 'images/uploads/small/'.$item['file']) }}" alt="{{ $item['name'] }}">  
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
            @else
            <div class="col-12">
                <a href="{{ $content['slug'] }}" class="w-100 text-decoration-none d-inline-flex align-items-center  border-bottom pb-2 mb-2 ">
                     @if(!empty($content['upload']) && count($content['upload']) > 0)
                        @foreach ($content['upload']->take(1) as $item)
                            <img class="rounded w-25 mr-4" src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                        @endforeach
                    @else
                        
                            <img class="rounded w-25 mr-4" src="{{ asset( 'images/uploads/thumb/'.$websettings['cms_no_image']) }}" alt="No Image">
                       
                    @endif
                    <span>{{ $content['name'] }}</span>
                </a>
            </div>
            @endif
        @endforeach
    </div>       
    </div>
    @include($websettings['cms_layout'].'.ads.middlecategory') 
</div>
@endif