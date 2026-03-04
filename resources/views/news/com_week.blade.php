@if(!empty($weeks) && count($weeks->Contents) > 0)
<div class="weekly-news-area pt-50">
    <div class="container">
       <div class="weekly-wrapper">
            <!-- section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle mb-30">
                        <h3>সাপ্তাহিক শীর্ষ সংবাদ</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="weekly-news-active dot-style d-flex dot-style">
                        @if(!empty($weeks) && count($weeks->Contents) > 0)
                            @foreach($weeks->Contents as $content)
                                <div class="weekly-single">
                                    <div class="weekly-img">
                                         @foreach ($content['upload'] as $item)
                                            <a href="{{ $content['slug'] }}">
                                                <img class="img-fluid" src="{{ asset( 'images/uploads/large/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                            </a>
                                            @break
                                        @endforeach
                                    </div>
                                    <div class="weekly-caption">
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