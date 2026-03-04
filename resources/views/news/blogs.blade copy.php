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
                <h2 class="d-blue bold fadeInUp" data-wow-delay="0.3s">Read Our Blogs</h2>
                {{-- <p class="fadeInUp" data-wow-delay="0.4s">We offer a comprehensive range of digital services designed to empower your business</p> --}}
            </div>
        
            <div class="row">
                @foreach($contents as $content)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <!-- Content -->
                    <div class="blog_single_content v2 text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                       
                        <div>
                            @foreach ($content->upload as $item)
                                <a href="{{ $content->slug }}">
                                    <img src="{{ asset( 'images/uploads/large/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                </a>
                                @break
                            @endforeach
                        </div>
                        <div class="service-content">
                            <h6 class="">
                            <a class="d-blue bold" href="{{ $content->slug }}">
                                {{ $content->name }}
                            </a>
                            </h6>
                        </div>
                    </div>
                </div>
                @endforeach
                

            </div>
        </div>
    </section>
@endsection