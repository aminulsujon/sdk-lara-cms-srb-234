<?php 
// dd($home_events);
?>

@if(!empty($home_events) && count($home_events['Contents']) > 0)
<section class="section-events">
  <h2><a href="{{ $home_events['slug'] }}">{{ $home_events['title'] }}</a></h2>
  <div class="container">
    <div class="row">
      <!-- News Card 1 -->
        
        <div class="col-md-4 mb-4 ">
            @foreach($home_events['Contents']->take(1) as $event)
                @include('news.blocks.newsCard',['content'=>$event])
            @endforeach
        </div>
       
        <div class="col-md-4 mb-4 ">
            @foreach($home_events['Contents']->skip(1)->take(3) as $content)
                @include('news.blocks.newsCardList',['content'=>$content])
            @endforeach
        </div>
        <div class="col-md-4 mb-4 ">
            @foreach($home_events['Contents']->skip(4)->take(1) as $event)
                @include('news.blocks.newsCard',['content'=>$event])
            @endforeach
        </div>
    </div>
  </div>
</section>
    <style>
        .section-events {
            background-color: {{ !empty($home_events['background']) ? $home_events['background'] : '#FFF' }};
            color: {{ !empty($home_events['color']) ? $home_events['color'] : '#000000' }};
        }

        .ncl a {
            background-color: {{ !empty($home_events['background']) ? $home_events['background'] : '#FFF' }};
            color: {{ !empty($home_events['color']) ? $home_events['color'] : '#000000' }};
        }
        
        .section-events {
                      
        }
        .section-events h2 a{
            color: {{ !empty($home_events['color']) ? $home_events['color'] : '#000000' }};
            display:block;
            text-align:center;
        }
        .section-events h2{
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(85, 85, 85, 0.3);;
            margin-bottom: 25px;
            padding-top: 15px;
        }

        /* animation: bgShift 20s linear infinite;
        @keyframes bgShift {
            0%   { background-color: #1e3c72; }
            25%  { background-color: #2a5298; }
            50%  { background-color: #7f00ff; }
            75%  { background-color: #00c6ff; }
            100% { background-color: #1e3c72; }
        } */

        /*pure black*/
        .trending-section-black {
            background-color: #000000;color:#fff;padding-top:15px
        }
        .trending-section-black .trending-header {
            color:#fff;
        }
        /*pure black*/

    </style>
@include($websettings['cms_layout']. '.ads.event') 
@endif