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
@endsection

@section('content')
<main>
    
    <!-- Trending Area Start -->
    @if(!empty($websettings['cms_home_events']) && $websettings['cms_home_events']==1)
        @include($websettings['cms_layout'].'.com_event')
    @endif
    <!-- Trending Area End -->

    <!-- Top Area Start -->
    @include($websettings['cms_layout'].'.com_top')
    <!--   Top start -->

    <!--   Weekly-News start -->
    {{-- @include($websettings['cms_layout'].'.com_week2') --}}
    
    @include($websettings['cms_layout'].'.ads.middle') 
    <!-- End Weekly-News -->
   <!-- Whats New Start -->
    <section class="container whats-news-area pb-20 pt-4">
        @if(!empty($leadcats) && count($leadcats) > 0)
            @foreach($leadcats as $leads)
                    @if($loop->iteration == 2)
                        <div class="row">
                            <div class="col-sm-8">
                            @include($websettings['cms_layout'].'.blocks.block2', ['leads' => $leads])
                            </div>
                    @elseif($loop->iteration == 3)
                        <div class="col-sm-4">
                            @include($websettings['cms_layout'].'.blocks.block3', ['leads' => $leads]) 
                            </div>
                        </div>
                
                    
                        @elseif($loop->iteration == 9)
                        <div class="row">
                            @include($websettings['cms_layout'].'.blocks.blockm3', ['leads' => $leads])
                    
                    @elseif($loop->iteration == 10)
                            @include($websettings['cms_layout'].'.blocks.blockm3', ['leads' => $leads]) 
                    @elseif($loop->iteration == 11)
                            @include($websettings['cms_layout'].'.blocks.blockm3', ['leads' => $leads])
                    @elseif($loop->iteration == 12)
                            @include($websettings['cms_layout'].'.blocks.blockm3', ['leads' => $leads])
                        </div>
                    
                    @elseif($loop->iteration == 13)
                        <div class="row">
                            @include($websettings['cms_layout'].'.blocks.blockm3', ['leads' => $leads])
                    @elseif($loop->iteration == 14)
                            @include($websettings['cms_layout'].'.blocks.blockm3', ['leads' => $leads]) 
                    @elseif($loop->iteration == 15)
                            @include($websettings['cms_layout'].'.blocks.blockm3', ['leads' => $leads])
                    @elseif($loop->iteration == 16)
                            @include($websettings['cms_layout'].'.blocks.blockm3', ['leads' => $leads])
                        </div>
                    
                       
                    @else
                        @if(!empty($leads->Contents) && count($leads->Contents) > 0)
                            @include($websettings['cms_layout'].'.blocks.block'.$loop->iteration, ['leads' => $leads])
                        @endif

                    @endif
                
                    @if($loop->iteration == 4)
                        {{-- @include($websettings['cms_layout'].'.blocks.areas', ['leads' => $leads,'head'=>'1']) --}}
                    @endif

                    @if($loop->iteration == 12)
                        {{-- @include($websettings['cms_layout'].'.blocks.archive_form') --}}
                    @endif

                    @if($loop->iteration == 16)
                        @include($websettings['cms_layout'].'.blocks.video')
                        @include($websettings['cms_layout'].'.blocks.photo')
                    @endif
                
            @endforeach
        @endif
    </section>
 
    </main>

@endsection