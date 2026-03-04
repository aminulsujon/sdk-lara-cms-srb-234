@extends('tsl.layouts.app')
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
    <meta property="og:image" content="{{ $websettings['cms_assets'] ?? '' }}images/uploads/large/{{ $pagesetting['meta_image'] ?? $websettings['cms_assets'].'/image/img.jpg' ?? '/image/img.jpg' }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{ $websettings['cms_sitename'] ?? 'Sitename' }}" />
    <meta name="twitter:creator" content="@ {{ $websettings['cms_author'] ?? 'Creator' }}" />
    <meta property="twitter:url" content="@ {{ $websettings['cms_assets'] ?? 'URL' }}/" />
    <meta property="twitter:title" content="{{ $pagesetting->meta_title ?? $websettings['cms_sitename'] ?? 'Title' }}" />
    <meta property="twitter:description" content="{{ $pagesetting->meta_description ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="twitter:keywords" content="{{ $pagesetting->meta_keywords ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="twitter:image" content="{{ $websettings['cms_assets'] ?? '' }}images/uploads/large/{{ $pagesetting['meta_image'] ?? $websettings['cms_assets'].'/image/img.jpg' ?? '/image/img.jpg' }}" />
@endsection

@section('schema')

	<script type="application/ld+json">
	
	</script>
@endsection
@section('content')
<section class="our_services_area section-padding-100-0" id="services">
        <div class="container">
            
            <div class="section-heading text-center mt-4">
                <h2 class="d-blue bold fadeInUp" data-wow-delay="0.3s">Creatives</h2>
            </div>
            
            <div class="border p-1 mb-2 text-center">
              <img class="" src="images/creatives/creative-250_250.jpg" alt="creative-250_250.jpg" />
              <span class="d-block text-center mt-4">250x250</span>
            </div>

            <div class="border p-1 mb-2 text-center">
              <img class="" src="images/creatives/creative-300_250.jpg" alt="creative-300_250.jpg" />
              <span class="d-block text-center mt-4">300x250</span>
            </div>

            <div class="border p-1 mb-2 text-center">
              <img class="" src="images/creatives/creative-320_50_2.jpg" alt="creative-320_50_2.jpg" />
              <span class="d-block text-center mt-4">300x250 2</span>
            </div>

            <div class="border p-1 mb-2 text-center">
              <img class="" src="images/creatives/creative-320_50.jpg" alt="creative-320_50.jpg" />
              <span class="d-block text-center mt-4">320x50</span>
            </div>

            <div class="border p-1 mb-2 text-center">
              <img class="" src="images/creatives/creative-320_100.jpg" alt="creative-320_100.jpg" />
              <span class="d-block text-center mt-4">320x100</span>
            </div>

            <div class="border p-1 mb-2 text-center">
              <img class="" src="images/creatives/creative-728_90_2.jpg" alt="creative-728_90_2.jpg" />
              <span class="d-block text-center mt-4">728x90 2</span>
            </div>

            <div class="border p-1 mb-2 text-center">
              <img class="" src="images/creatives/creative-728_90.jpg" alt="creative-728_90.jpg" />
              <span class="d-block text-center mt-4">728x90</span>
            </div>
        </div>
    </section>
@endsection