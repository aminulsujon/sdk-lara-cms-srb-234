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
            <h3>সর্বশেষ সংবাদ</h3>
        </div>
        <div class="row">
        @foreach($contents as $content)
            @if($loop->iteration % 7 === 0)
                @include($websettings['cms_layout'].'.ads.middle')
            @endif
            <div class="col-12 col-md-6 border-b mt-4">
                <div class="row">
                    <div class="col-4 col-md-4">
                        @foreach ($content['upload'] as $item)
                            <a href="{{ $content['slug'] }}">
                                <img class="img-fluid" src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                            </a>
                            @break
                        @endforeach
                    </div>
                    <div class="col-8 col-md-8">
                        <h4 class=""><a href="{{ $content->slug }}">{{ $content->name }}</a></h4>
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
        </div>
    </div>
    <!--Recent Articles End -->

    

    <!--Start pagination -->
    <div class="pagination-area pb-45 text-center mt-4">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    {{ $contents->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- End pagination  -->
    </main>

@endsection