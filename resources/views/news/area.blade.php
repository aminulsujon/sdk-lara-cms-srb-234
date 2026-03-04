@extends($websettings['cms_layout'].'.layouts.app')

@section('social')
	<meta name="robots" content="{{ $pagesetting->meta_robots ?? 'index,allow' }}" />
    <title>{{ $pagesetting->meta_title ?? $websettings['cms_sitename'] ?? 'Title' }}</title>
    <meta name="description" content="{{ $pagesetting->meta_description ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <link rel="canonical" href="{{ $websettings['cms_url'] ?? 'URL' }}/" />
    <meta property="site_name" content="{{ $websettings['cms_sitename'] ?? 'Site Name' }}" />
    <meta property="og:url" content="{{ $websettings['cms_url'] ?? 'URL' }}/" />
    <meta property="og:title" content="{{ $pagesetting->meta_title ?? $websettings['cms_sitename'] ?? 'Title' }}" />
    <meta property="og:description" content="{{ $pagesetting->meta_description ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="og:keywords" content="{{ $pagesetting->meta_keywords ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="og:image" content="{{ $websettings['cms_assets'] ?? '' }}images/uploads/large/{{ $pagesetting['meta_image'] ?? '' }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{ $websettings['cms_sitename'] ?? 'Sitename' }}" />
    <meta name="twitter:creator" content="@ {{ $websettings['cms_author'] ?? 'Creator' }}" />
    <meta property="twitter:url" content="@ {{ $websettings['cms_assets'] ?? 'URL' }}/" />
    <meta property="twitter:title" content="{{ $pagesetting->meta_title ?? $websettings['cms_sitename'] ?? 'Title' }}" />
    <meta property="twitter:description" content="{{ $pagesetting->meta_description ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="twitter:keywords" content="{{ $pagesetting->meta_keywords ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="twitter:image" content="{{ $websettings['cms_assets'] ?? '' }}images/uploads/large/{{ $pagesetting['meta_image'] ?? '' }}" />
    <style>
    .pagination-area svg{width: 20px}
    .pagination-area p{margin-top: 20px}
    </style>
@endsection

@section('content')
<?php
function enToBnDate($datetime){
    $en = ['0','1','2','3','4','5','6','7','8','9','AM','PM','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯','এএম','পিএম','জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'];
    return str_replace($en, $bn, $datetime);
}
?>
<main>
    <!-- Trending Area End -->
    <div class="container mt-4">
        <div class="section-tittle mb-30">
            <h1 class="fs-3"><svg width="20" height="20" viewBox="0 0 32 32" fill="#dd3633">
                <path d="M16 10.667A5.332 5.332 0 0 0 10.668 16a5.332 5.332 0 0 0 5.334 5.333A5.332 5.332 0 0 0 21.334 16a5.332 5.332 0 0 0-5.333-5.333zm11.92 4A11.992 11.992 0 0 0 17.335 4.08V1.333h-2.667V4.08A11.992 11.992 0 0 0 4.081 14.667H1.334v2.666h2.747A11.992 11.992 0 0 0 14.667 27.92v2.747h2.667V27.92a11.992 11.992 0 0 0 10.587-10.587h2.746v-2.666h-2.746zM16 25.333A9.327 9.327 0 0 1 6.668 16a9.327 9.327 0 0 1 9.334-9.333A9.327 9.327 0 0 1 25.334 16a9.327 9.327 0 0 1-9.333 9.333z"/>
            </svg>
            <span class="txt-cx">আমার এলাকার খবর: 
                @if(!empty($taga))
                    @foreach($taga as $tage)
                    <span class="mt-2 ml-2">{{$tage['title']}}</span>
                    @endforeach
                @endif
            </span></h1>
        </div>
        @include($websettings['cms_layout'].'.blocks.areas',['head'=>false])
        <?php
        // dd($taga);
        ?>
        @if(!empty($taga))
            @foreach($taga as $tage)
            <div class="mt-2">{{$tage['title']}}</div>
                @foreach($tage->Contents->unique('id') as $content)
                    @if($loop->iteration % 7 === 0)
                        @include($websettings['cms_layout'].'.ads.middle')
                    @endif
                    <div class="border mt-4">
                        <div class="row">
                            <div class="col-4 col-md-2">
                                @foreach ($content['upload'] as $item)
                                    <a href="{{ $content['slug'] }}">
                                        <img class="img-fluid" src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                    </a>
                                    @break
                                @endforeach
                            </div>
                            <div class="col-8 col-md-10">
                                <h4 class="pt-0 pt-md-3"><a href="{{ $content->slug }}">{{ $content->name }}</a></h4>
                                <div class="d-none d-md-block">
                                    <svg fill="#ddd" width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <title>time</title>
                                        <path d="M0 16q0-3.232 1.28-6.208t3.392-5.12 5.12-3.392 6.208-1.28q3.264 0 6.24 1.28t5.088 3.392 3.392 5.12 1.28 6.208q0 3.264-1.28 6.208t-3.392 5.12-5.12 3.424-6.208 1.248-6.208-1.248-5.12-3.424-3.392-5.12-1.28-6.208zM4 16q0 3.264 1.6 6.048t4.384 4.352 6.016 1.6 6.016-1.6 4.384-4.352 1.6-6.048-1.6-6.016-4.384-4.352-6.016-1.632-6.016 1.632-4.384 4.352-1.6 6.016zM14.016 16v-5.984q0-0.832 0.576-1.408t1.408-0.608 1.408 0.608 0.608 1.408v4h4q0.8 0 1.408 0.576t0.576 1.408-0.576 1.44-1.408 0.576h-6.016q-0.832 0-1.408-0.576t-0.576-1.44z"></path>
                                    </svg>&nbsp;&nbsp; <time datetime="{{ $content->created_at }}">{{ enToBnDate(date('d M Y h:i A', strtotime($content->created_at))) }}</time>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>
    <!--Recent Articles End -->

    

    

    <!-- End pagination  -->
    </main>

@endsection