@extends('tsl.layouts.app')
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
      .details h3,.details h2,.details h4{margin-top:20px}  
      .details input{display:none}
    </style>
@endsection

@section('schema')

	<script type="application/ld+json">
	
	</script>
@endsection
@section('content')
<section class="our_services_area section-padding-100-0" id="services">
        <div class="container">
            
            <div class="section-heading mt-4">
                <h1 class="d-blue bold fadeInUp" data-wow-delay="0.3s">{{ $content->name }}</h1>
                <div class="border-top pt-4">Published at: <time datetime="{{ $content->created_at }}">{{ $content->created_at }}</time></div>
                {{-- <p class="fadeInUp" data-wow-delay="0.4s">We offer a comprehensive range of digital services designed to empower your business</p> --}}
                <div class="mt-4">
                    @foreach ($content->upload as $item)
                        <a href="{{ $content->slug }}">
                            <img src="{{ asset( 'images/uploads/large/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                        </a>
                        @break
                    @endforeach
                </div>
            </div>
            <div class="details mt-4 mb-4">{!! $content->details !!}</div>

            <div class="mt-4 border-top">@include('blog.com_more_services_list') </div>
        </div>
    </section>
@endsection