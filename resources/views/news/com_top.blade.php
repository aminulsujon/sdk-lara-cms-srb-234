
@if(!empty($tops))
<div class="trending-area fix mt-4">
    <div class="container">
        <div class="trending-main">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Trending Top 1-->
                        <div class="trending-top">
                            <div class="trend-top-img">
                                @if(!empty($tops->Contents[0]))
                                    @foreach ($tops->Contents[0]['upload'] as $item)
                                        <a href="{{ $tops->Contents[0]['slug'] }}">
                                            @include('clip.img',['filename'=>$item['file']])
                                        </a>
                                        @break
                                    @endforeach
                                    <div class="mt-2 rounded-bottom">
                                        <h2><a href="{{ $tops->Contents[0]['slug'] }}">{{ $tops->Contents[0]['name'] }}</a></h2>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right content : Top 5 -->
                    <div class="col-lg-4 rolled">
                        @foreach($tops->Contents->skip(1)->take(4) as $content)
                            @include('news.blocks.newsList',['content'=>$content])
                        @endforeach
                    </div>
                    <div class="col-lg-3">

                        <div class="ramadan-border">

                        <div class="ramadan-card">

                        <div class="ramadan-title">
                        🌙 ঢাকা সেহরি ও ইফতার সময়
                        </div>

                        <p id="date"></p>

                        <div class="time-box">
                        সেহরি শেষ: <strong id="sehri">Loading...</strong>
                        </div>

                        <div class="time-box">
                        ইফতার: <strong id="iftar">Loading...</strong>
                        </div>

                        </div>

                        </div>

                        <script>

                        async function loadRamadanTime(){

                        const response = await fetch(
                        "https://api.aladhan.com/v1/timingsByCity?city=Dhaka&country=Bangladesh&method=1"
                        );

                        const data = await response.json();

                        document.getElementById("sehri").innerText = data.data.timings.Fajr;
                        document.getElementById("iftar").innerText = data.data.timings.Maghrib;
                        document.getElementById("date").innerText = "তারিখ: " + data.data.date.readable;

                        }

                        loadRamadanTime();

                        </script>
                    </div>
                </div>

                {{-- <div class="row"> --}}
                <!-- Trending Bottom 4 -->
                <div class="trending-bottom border-top pt-4">
                    <div class="row">
                        @foreach($tops->Contents->skip(5)->take(4) as $content)
                            <div class="col-6 col-md-3  @if(!$loop->last) border-right @endif">
                                <div class="single-bottom">
                                    <div class="mb-4">
                                        @foreach ($content['upload'] as $item)
                                            <a href="{{ $content['slug'] }}">
                                                <img class="img-fluid" src="{{ asset( 'images/uploads/small/'.$item['file']) }}" alt="{{ $item['name'] }}" loading="lazy">  
                                            </a>
                                            @break
                                        @endforeach
                                    </div>
                                    
                                    <div class="trend-bottom-cap">
                                        <h4><a class="font-weight-bold" href="{{ $content->slug }}">{{ $content->name }}</a></h4>
                                        {{-- <time class="text-muted">@include($websettings['cms_layout'].'.com_times_ago')</time> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{-- </div> --}}

                <div class="trending-bottom border-top mt-3 pt-3">
                    <div class="row">
                        @foreach($tops->Contents->skip(9)->take(4) as $content)                      
                            <div class="col-6 col-md-3  @if(!$loop->last) border-right @endif">
                                <div class="single-bottom mb-4">
                                    <div class="trend-bottom-cap">
                                        <h4><a class="font-weight-bold" href="{{ $content->slug }}">{{ $content->name }}</a></h4>
                                    </div>
                                    <span class="details_preview">{{ Str::limit($content->summary, 50) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
</div>

@endif