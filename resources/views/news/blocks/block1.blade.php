@if(!empty($leads) && count($leads->Contents) > 0)
    <div class="weekly2-news-area gray-bg pt-4 mt-4 mt-md-0 mb-4">
        <div class="container">
            <div class="weekly2-wrapper">
                <!-- সেকশন শিরোনাম -->
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
                <div class="row">
                    <div class="col-12">
                        <div class="weekly2-news-active dot-style d-flex dot-style">
                            @if(!empty($leads) && count($leads->Contents) > 0)
                            @foreach($leads->Contents as $content)
                            <div class="weekly2-single">
                                <div class="weekly2-img">
                                    @foreach ($content['upload'] as $item)
                                        <a href="{{ $content['slug'] }}">
                                            <img class="img-fluid" src="{{ asset( 'images/uploads/small/'.$item['file']) }}" alt="{{ $item['name'] }}" loading="lazy">  
                                        </a>
                                        @break
                                    @endforeach
                                </div>
                                <div class="weekly2-caption">
                                    <span class="color1"></span>
                                    <p></p>
                                    <h4><a href="{{ $content->slug }}">{{ $content->name }}</a></h4>
                                </div>
                            </div> 
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
