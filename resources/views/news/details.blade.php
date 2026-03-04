@extends($websettings['cms_layout'].'.layouts.app')
@section('social')
    <?php
    if(!empty($content->upload) && count($content->upload) > 0){
        foreach ($content->upload as $gfx) {
            if(!empty($gfx['file']) && file_exists(public_path('images/uploads/large/'.$gfx['file']))){
                $content_image = $gfx['file'];
                break;
            }
        }
    } else{
        $content_image = null;
    }
    ?>
	<meta name="robots" content="{{ $pagesetting->meta_robots ?? 'index,allow' }}" />
    <title>{{ $pagesetting->meta_title ?? $content['name'] ?? $websettings['cms_sitename'] ?? 'Title' }}</title>
    <meta name="description" content="{{ $pagesetting->meta_description ?? strip_tags($content['details']) ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <link rel="canonical" href="{{ $websettings['cms_url']. $content->slug }}" />
    <meta property="site_name" content="{{ $websettings['cms_sitename'] ?? 'Site Name' }}" />
    <meta property="og:url" content="{{ $websettings['cms_url']. $content->slug }}/" />
    <meta property="og:title" content="{{ $pagesetting->meta_title ?? $content['name'] ?? 'Title' }}" />
    <meta property="og:description" content="{{ $pagesetting->meta_description ?? strip_tags($content['details']) ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="og:keywords" content="{{ $pagesetting->meta_keywords ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="og:image" content="{{ $websettings['cms_assets'] }}images/uploads/large/{{ $pagesetting['meta_image'] ?? $content_image ?? $websettings['cms_image'] ?? 'cyber-bit-byte-services.webp' }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{ $websettings['cms_sitename'] ?? 'Sitename' }}" />
    <meta name="twitter:creator" content="@ {{ $websettings['cms_author'] ?? 'Creator' }}" />
    <meta property="twitter:url" content="@ {{ $websettings['cms_assets']. $content->slug }}/" />
    <meta property="twitter:title" content="{{ $pagesetting->meta_title ?? $content['name'] ?? $websettings['cms_sitename'] ?? 'Title' }}" />
    <meta property="twitter:description" content="{{ $pagesetting->meta_description ?? strip_tags($content['details']) ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="twitter:keywords" content="{{ $pagesetting->meta_keywords ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="twitter:image" content="{{ $websettings['cms_assets'] }}images/uploads/large/{{ $pagesetting['meta_image'] ?? $content_image ?? $websettings['cms_image'] ?? 'cyber-bit-byte-services.webp' }}" />
    
@endsection
<?php
function enToBnDate($datetime){
    $en = ['0','1','2','3','4','5','6','7','8','9','AM','PM','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯','এএম','পিএম','জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'];
    return str_replace($en, $bn, $datetime);
}
?>
@section('schema')

<script type="application/ld+json">

</script>
@endsection
@section('content')
<main>
    <!-- Trending Area Start -->
    <div class="trending-area fix mt-4">
        <div class="container">
            <div class="trending-main">
                
                <div class="row">
                    <div class="col-md-8">
                        
                        <div class="trending-bottom details">
                            <div class="section-heading">
                                @if(!empty($content->subtitle ))
                                    <h2 class="d-blue bold fadeInUp subtitle" data-wow-delay="0.3s">{{ $content->subtitle }}</h2>
                                @endif
                                <h1 class="d-blue bold fadeInUp" data-wow-delay="0.3s">{{ $content->name }}</h1>
                                @if(!empty($content->tags))
                                    <div class="tags mt-2">
                                        @foreach($content->tags->where('tag_type', 3) as $tag)
                                            <a href="{{ $tag->slug }}" class="cats">{{ $tag->title }}</a>
                                        @endforeach
                                    </div>
                                @endif
                            
                                <div class="pt-2 d-flex">
                                    <span class="tags">
                                        <svg fill="#ddd" width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <title>time</title>
                                            <path d="M0 16q0-3.232 1.28-6.208t3.392-5.12 5.12-3.392 6.208-1.28q3.264 0 6.24 1.28t5.088 3.392 3.392 5.12 1.28 6.208q0 3.264-1.28 6.208t-3.392 5.12-5.12 3.424-6.208 1.248-6.208-1.248-5.12-3.424-3.392-5.12-1.28-6.208zM4 16q0 3.264 1.6 6.048t4.384 4.352 6.016 1.6 6.016-1.6 4.384-4.352 1.6-6.048-1.6-6.016-4.384-4.352-6.016-1.632-6.016 1.632-4.384 4.352-1.6 6.016zM14.016 16v-5.984q0-0.832 0.576-1.408t1.408-0.608 1.408 0.608 0.608 1.408v4h4q0.8 0 1.408 0.576t0.576 1.408-0.576 1.44-1.408 0.576h-6.016q-0.832 0-1.408-0.576t-0.576-1.44z"></path>
                                        </svg>&nbsp; <time datetime="{{ $content->created_at }}">{{ enToBnDate(date('d M Y h:i A', strtotime($content->created_at))) }}</time>
                                    </span>
                                </div>
                                @if(!empty($content->summary ))
                                    <div class="summary mt-2 mb-4">{!! $content->summary !!}</div>
                                @endif
                            </div>
                            <!-- Image -->
                            @if(!empty($content->upload[0]))
                                <div class="mt-2 border p-2">
                                   
                                        @include('clip.img',['filename'=>$content->upload[0]['file'],'width'=>'','height'=>''])
                                        @if(!empty($content->upload[0]['caption']))
                                            <div class="font-italic mt-2">
                                                {{ $content->upload[0]['caption'] }}
                                            </div>
                                        @endif
                                   
                                </div>
                            @endif
                            <!-- Reporters -->
                            @if(!empty($content->tags))
                                <div class="tags mr-3 mt-4">
                                    @foreach($content->tags->where('tag_type', 6) as $tag)
                                    
                                        <span>
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.5" d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                                <path d="M17.3009 2.80624L16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9L8.03811 15.0229C7.9492 15.2897 8.01862 15.5837 8.21744 15.7826C8.41626 15.9814 8.71035 16.0508 8.97709 15.9619L10.1 15.5876L11.8354 15.0091C12.3775 14.8284 12.6485 14.7381 12.9035 14.6166C13.2043 14.4732 13.4886 14.2975 13.7513 14.0926C13.9741 13.9188 14.1761 13.7168 14.5801 13.3128L20.5449 7.34795L21.1938 6.69914C22.2687 5.62415 22.2687 3.88124 21.1938 2.80624C20.1188 1.73125 18.3759 1.73125 17.3009 2.80624Z" stroke="#1C274C" stroke-width="1.5"/>
                                                <path opacity="0.5" d="M16.6522 3.45508C16.6522 3.45508 16.7333 4.83381 17.9499 6.05034C19.1664 7.26687 20.5451 7.34797 20.5451 7.34797M10.1002 15.5876L8.4126 13.9" stroke="#1C274C" stroke-width="1.5"/>
                                            </svg>&nbsp;
                                            <span class="cats">{{ $tag->title }}</span>
                                        </span>
                                    @endforeach
                                    <span class="ml-0">
                                    @foreach($content->tags->where('tag_type', 8) as $tag)
                                        <span class="border-0 mr-2">
                                            <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none"><path d="M16 10.667A5.332 5.332 0 0 0 10.668 16a5.332 5.332 0 0 0 5.334 5.333A5.332 5.332 0 0 0 21.334 16a5.332 5.332 0 0 0-5.333-5.333zm11.92 4A11.992 11.992 0 0 0 17.335 4.08V1.333h-2.667V4.08A11.992 11.992 0 0 0 4.081 14.667H1.334v2.666h2.747A11.992 11.992 0 0 0 14.667 27.92v2.747h2.667V27.92a11.992 11.992 0 0 0 10.587-10.587h2.746v-2.666h-2.746zM16 25.333A9.327 9.327 0 0 1 6.668 16a9.327 9.327 0 0 1 9.334-9.333A9.327 9.327 0 0 1 25.334 16a9.327 9.327 0 0 1-9.333 9.333z" fill="#dd3633"></path></svg>
                                            <span class="cats">{{ $tag->title }}</span>
                                        </span>
                                    @endforeach
                                    </span>
                                </div>
                            @endif
                            <!-- Details Content -->
                            <div class="details-content mt-4 mb-4">{!! $content->details !!}</div>
                            <!-- Additional Images -->
                            @if(count($content->upload) > 1)
                                <div class="mt-4">
                                    @foreach ($content->upload->skip(1) as $item)
                                        <div class="mb-4 border p-4">
                                            @include('clip.img',['filename'=>$item['file'],'width'=>'','height'=>''])
                                            <div class="mt-2 font-italic">{{ $item['caption'] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                    </div>

                    <!-- Right content -->
                    <div class="col-md-4">
                        {{-- @if(!empty($websettings['cms_ads_status'])) --}}
                            <div class="mb-4 border p-2 bg-gray-100">
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3157939455051527"
                                    crossorigin="anonymous"></script>
                                <!-- cx-300x250-fixed -->
                                <ins class="adsbygoogle"
                                    style="display:inline-block;width:300px;height:250px"
                                    data-ad-client="ca-pub-3157939455051527"
                                    data-ad-slot="7678667557"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </div> 
                        {{-- @endif --}}
                        
                        {{-- @if(!empty($content->tags)) --}}
                            {{-- @foreach($content->tags->where('tag_type', 3)->take(1) as $tag)
                                @foreach($tag->contents->take(5) as $contents_more) --}}
                                @foreach($contents as $contents_more)
                                    @if($contents_more->id != $content->id)
                                        <a href="{{ $contents_more->slug }}" class="w-100 text-decoration-none d-inline-flex justify-content-between align-items-center @if (!$loop->last) border-bottom pb-2 mb-2 @else pb-2 @endif">
                                            <span class="fw-bold">{{ $contents_more->name }}</span>  
                                            @if(!empty($contents_more['upload']) && count($contents_more['upload']) > 0)
                                                @foreach ($contents_more['upload']->take(1) as $item)
                                                    <img 
                                                        class="rounded w-25 ml-4"
                                                            src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}"
                                                            alt="{{ $item['name'] }}"
                                                        >
                                                @endforeach
                                            @endif
                                        </a>
                                                
                                    @endif
                                @endforeach
                                {{-- @endforeach
                            @endforeach --}}
                        {{-- @endif --}}
                    </div>
                </div>
                
                @include($websettings['cms_layout'].'.ads.middle')

            </div>
        </div>
    </div>
</main>
@endsection