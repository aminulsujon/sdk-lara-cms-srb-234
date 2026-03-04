@extends('blog.layouts.app')
@section('social')

	<meta name="robots" content="{{ $pagesetting->meta_robots ?? 'index,allow' }}" />
    <title>{{ $pagesetting->meta_title ?? $content['name'] ?? $websettings['cms_sitename'] ?? 'Title' }}</title>
    <meta name="description" content="{{ $pagesetting->meta_description ?? strip_tags($content['details']) ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <link rel="canonical" href="{{ $websettings['cms_url'] ?? 'URL' }}/" />
    <meta property="site_name" content="{{ $websettings['cms_sitename'] ?? 'Site Name' }}" />
    <meta property="og:url" content="{{ $websettings['cms_url'] ?? 'URL' }}/" />
    <meta property="og:title" content="{{ $pagesetting->meta_title ?? $content['name'] ?? 'Title' }}" />
    <meta property="og:description" content="{{ $pagesetting->meta_description ?? strip_tags($content['details']) ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="og:keywords" content="{{ $pagesetting->meta_keywords ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="og:image" content="{{ $pagesetting['meta_image'] ?? $websettings['cms_assets'].'/image/img.jpg' ?? '/image/img.jpg' }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{ $websettings['cms_sitename'] ?? 'Sitename' }}" />
    <meta name="twitter:creator" content="@ {{ $websettings['cms_author'] ?? 'Creator' }}" />
    <meta property="twitter:url" content="@ {{ $websettings['cms_assets'] ?? 'URL' }}/" />
    <meta property="twitter:title" content="{{ $pagesetting->meta_title ?? $content['name'] ?? $websettings['cms_sitename'] ?? 'Title' }}" />
    <meta property="twitter:description" content="{{ $pagesetting->meta_description ?? strip_tags($content['details']) ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="twitter:keywords" content="{{ $pagesetting->meta_keywords ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="twitter:image" content="{{ $pagesetting['meta_image'] ?? $websettings['cms_assets'].'/image/img.jpg' ?? '/image/img.jpg' }}" />
    <style>
        .details h1{margin-top: 10px}
      .details h3,.details h2,.details h4{margin-top:20px}  
      .details input,.ql-tooltip{display:none}
      .details img{max-width: 100%;height:auto;}
      .details .subtitle{font-size: 20px;
        color: #007aa7;
        background-color: #ddd;
        display: inline;
        padding: 1px 10px;
        border-radius: 10px;}
      .details .summary{font-size: 20px;font-weight: normal;color:#333;font-style: italic;font-weight: 600}
      .details .tags {padding: 5px 0;}
      .details .tags a{border:1px solid #ddd;padding:5px 10px;margin-right:5px;border-radius:5px;font-size:14px;color:#007aa7;text-decoration:none}
    </style>
@endsection

@section('schema')

	<script type="application/ld+json">
	
	</script>
@endsection
@section('content')
<section class="details section-padding-100-0" id="services">
        <div class="container">
            <div class="trending-area fix mt-4">
                <div class="container">
                    <div class="trending-main">
                    <div class="row">
                        <div class="col-md-8">
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
                                    @if(!empty($content->tags))
                                        <div class="tags mr-3">
                                            @foreach($content->tags->where('tag_type', 6) as $tag)
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.5" d="M22 10.5V12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2H13.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                                <path d="M17.3009 2.80624L16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9L8.03811 15.0229C7.9492 15.2897 8.01862 15.5837 8.21744 15.7826C8.41626 15.9814 8.71035 16.0508 8.97709 15.9619L10.1 15.5876L11.8354 15.0091C12.3775 14.8284 12.6485 14.7381 12.9035 14.6166C13.2043 14.4732 13.4886 14.2975 13.7513 14.0926C13.9741 13.9188 14.1761 13.7168 14.5801 13.3128L20.5449 7.34795L21.1938 6.69914C22.2687 5.62415 22.2687 3.88124 21.1938 2.80624C20.1188 1.73125 18.3759 1.73125 17.3009 2.80624Z" stroke="#1C274C" stroke-width="1.5"/>
                                                <path opacity="0.5" d="M16.6522 3.45508C16.6522 3.45508 16.7333 4.83381 17.9499 6.05034C19.1664 7.26687 20.5451 7.34797 20.5451 7.34797M10.1002 15.5876L8.4126 13.9" stroke="#1C274C" stroke-width="1.5"/>
                                            </svg>&nbsp;&nbsp;<span class="cats">{{ $tag->title }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <span class="tags">
                                        <svg fill="#ddd" width="20px" height="20px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <title>time</title>
                                            <path d="M0 16q0-3.232 1.28-6.208t3.392-5.12 5.12-3.392 6.208-1.28q3.264 0 6.24 1.28t5.088 3.392 3.392 5.12 1.28 6.208q0 3.264-1.28 6.208t-3.392 5.12-5.12 3.424-6.208 1.248-6.208-1.248-5.12-3.424-3.392-5.12-1.28-6.208zM4 16q0 3.264 1.6 6.048t4.384 4.352 6.016 1.6 6.016-1.6 4.384-4.352 1.6-6.048-1.6-6.016-4.384-4.352-6.016-1.632-6.016 1.632-4.384 4.352-1.6 6.016zM14.016 16v-5.984q0-0.832 0.576-1.408t1.408-0.608 1.408 0.608 0.608 1.408v4h4q0.8 0 1.408 0.576t0.576 1.408-0.576 1.44-1.408 0.576h-6.016q-0.832 0-1.408-0.576t-0.576-1.44z"></path>
                                        </svg>&nbsp;&nbsp; প্রকাশিত: <time datetime="{{ $content->created_at }}">{{ date('d M Y H:i', strtotime($content->created_at)) }}</time>
                                    </span>
                                </div>
                                @if(!empty($content->summary ))
                                    <div class="summary mt-2 mb-4">{!! $content->summary !!}</div>
                                @endif
                
                                <div class="mt-2">
                                    @foreach ($content->upload as $item)
                                        <a href="{{ $content->slug }}">
                                            <img style="img-fluid" src="{{ asset( 'images/uploads/large/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                        </a>
                                        @break
                                    @endforeach
                                </div>
                            </div>
                            <div class="details-content mt-4 mb-4">{!! $content->details !!}</div>
                        </div>
                        <div class="col-md-4">
                            @if(!empty($websettings['cms_ads_status']))
                                <div class="mb-4">
                                    @include('blog.ads.300x250',['width'=>300,'height'=>250,'position'=>'Details R1','text'=>'Advertisment 300x250'])
                                </div> 
                            @endif
        
                            @if(!empty($content->tags))
                                @foreach($content->tags->where('tag_type', 3)->take(1) as $tag)
                                    @foreach($tag->contents->take(5) as $contents_more)
                                        @if($contents_more->id != $content->id)
                                        <div class="trand-right-single d-flex">
                                            <div class="trand-right-img">
                                                @foreach ($contents_more['upload'] as $item_more)
                                                    <a href="{{ $contents_more['slug'] }}">
                                                        <img src="{{ asset( 'images/uploads/thumb/'.$item_more['file']) }}" alt="{{ $item_more['name'] }}">  
                                                    </a>
                                                    @break
                                                @endforeach
                                            </div>
                                            <div class="trand-right-cap">
                                                <h4><a href="{{ $contents_more->slug }}">{{ $contents_more->name }}</a></h4>
                                            </div>
                                        </div>
                                        @endif
        
                                    @endforeach
                                    
                                @endforeach
                            @endif
                        </div>
                    </div>
        

                    </div>
                </div>
            </div>
            
        </div>
    </section>
@endsection