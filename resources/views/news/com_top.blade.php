
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
                                    <div class="trend-top-cap rounded-bottom">
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
                        <div id="ramadan-widget" style="max-width:400px;padding:15px;border:1px solid #ddd;border-radius:10px;font-family:sans-serif">
                            <h3 style="text-align:center">ঢাকা সেহরি ও ইফতার সময়</h3>
                            <p id="date"></p>
                            <p><strong>সেহরি শেষ:</strong> <span id="sehri"></span></p>
                            <p><strong>ইফতার:</strong> <span id="iftar"></span></p>
                            </div>

                            <script>
                            async function loadRamadanTime(){
                            const res = await fetch("https://api.aladhan.com/v1/timingsByCity?city=Dhaka&country=Bangladesh&method=1");
                            const data = await res.json();

                            const sehri = data.data.timings.Fajr;
                            const iftar = data.data.timings.Maghrib;
                            const date = data.data.date.readable;

                            document.getElementById("sehri").innerText = sehri;
                            document.getElementById("iftar").innerText = iftar;
                            document.getElementById("date").innerText = "তারিখ: " + date;
                            }

                            loadRamadanTime();
                            </script>
                    </div>
                </div>

                {{-- <div class="row"> --}}
                <!-- Trending Bottom 4 -->
                <div class="trending-bottom border-top pt-4">
                    <div class="row">
                        @foreach($tops->Contents->skip(6)->take(4) as $content)
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
                        @foreach($tops->Contents->skip(10)->take(4) as $content)                      
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