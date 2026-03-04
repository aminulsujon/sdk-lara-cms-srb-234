<div class="container">
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
                <div class="row">
                    @foreach($leads->Contents as $content)
                        <div class="col-6 col-lg-4 col-md-3">
                            <div class="single-what-news mb-100">
                                <div class="what-img">
                                    @foreach ($content['upload'] as $item)
                                        <a href="{{ $content['slug'] }}">
                                            <img class="img-fluid" src="{{ asset( 'images/uploads/large/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                        </a>
                                        @break
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <h4><a href="{{ $content['slug'] }}">{{ $content['name'] }}</a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include($websettings['cms_layout'].'.ads.middlecategory') 
</div>