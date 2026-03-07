@extends($websettings['cms_layout'].'.layouts.app')

@section('social')
	<meta name="robots" content="{{ $pagesetting->meta_robots ?? 'index,allow' }}" />
    <title>{{ $pagesetting->meta_title ?? $tag->title ?? $websettings['cms_sitename'] ?? 'Title' }}</title>
    <meta name="description" content="{{ $pagesetting->meta_description ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <link rel="canonical" href="{{ $websettings['cms_url'] ?? 'URL' }}/" />
    <meta property="site_name" content="{{ $websettings['cms_sitename'] ?? 'Site Name' }}" />
    <meta property="og:url" content="{{ $websettings['cms_url'] ?? 'URL' }}/" />
    <meta property="og:title" content="{{ $pagesetting->meta_title ?? $tag->title ?? $websettings['cms_sitename'] ?? 'Title' }}" />
    <meta property="og:description" content="{{ $pagesetting->meta_description ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="og:keywords" content="{{ $pagesetting->meta_keyword ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="og:image" content="{{ $websettings['cms_assets'] ?? '' }}images/uploads/large/{{ $pagesetting['meta_image'] ?? '' }}" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="{{ $websettings['cms_sitename'] ?? 'Sitename' }}" />
    <meta name="twitter:creator" content="@{{ $websettings['cms_author'] ?? 'Creator' }}" />
    <meta property="twitter:url" content="@{{ $websettings['cms_assets'] ?? 'URL' }}/" />
    <meta property="twitter:title" content="{{ $pagesetting->meta_title ?? $tag->title ?? $websettings['cms_sitename'] ?? 'Title' }}" />
    <meta property="twitter:description" content="{{ $pagesetting->meta_description ?? $websettings['cms_sitename'] ?? 'Description' }}" />
    <meta property="twitter:keywords" content="{{ $pagesetting->meta_keywords ?? $websettings['cms_sitename'] ?? 'Keywords' }}" />
    <meta property="twitter:image" content="{{ $websettings['cms_assets'] ?? '' }}images/uploads/large/{{ $pagesetting['meta_image'] ?? '' }}" />
@endsection

@section('content')
<main>
<?php
function enToBnDate($datetime){
    $en = ['0','1','2','3','4','5','6','7','8','9','AM','PM','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯','এএম','পিএম','জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'];
    return str_replace($en, $bn, $datetime);
}
// dd($tag);
?>
    <div class="trending-area fix mt-4">
        <div class="container">
            <div class="trending-main">
                <div class="section-tittle mb-30">
                    <h3>{{ $tag->title ?? '' }}</h3>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        @if(!empty($tag->contents))
                        @php
                            $tag->contents = $tag->contents->sortByDesc('id');
                        @endphp
                        <div class="trending-bottom">
                            <div class="row">
                            {{--  --}}
                            @foreach($tag->contents->take(6)->where('status',1) as $content)
                                <div class="col-6 col-md-4">
                                    <div class="single-bottom mb-35">
                                        <div class="trend-bottom-img mb-30">
                                            @foreach ($content['upload'] as $item)
                                                <a href="{{ $content['slug'] }}">
                                                    <img src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                                </a>
                                                @break
                                            @endforeach
                                        </div>
                                        <div class="trend-bottom-cap">
                                            <h4><a href="{{ $content['slug'] }}">{{ $content->name }}</a></h4>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                            </div>
                        </div>
                        @else
                            <p></p>
                        @endif
                    </div>

                    <!-- Right content -->
                    <div class="col-lg-4">
                                               
                        @foreach($tag->contents->skip(6)->take(2) as $content)
                            @include('news.blocks.newsList',['content'=>$content])
                        @endforeach
                    </div>
                </div>
                
                @include($websettings['cms_layout'].'.ads.middle')

                <div id="contentBox" class="container mt-4">
                    @foreach($tag->contents->skip(8) as $content)
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
                        @if($loop->iteration % 7 === 0)
                            @include($websettings['cms_layout'].'.ads.middle')
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
    
</main>
<script>
let loading = false;

document.getElementById('lmb').addEventListener('click', function () {

    if (loading) return;
    loading = true;

    const btn  = this;
    const slug = btn.dataset.slug;
    let page   = parseInt(btn.dataset.page) + 1;

    btn.disabled = true;
    btn.textContent = 'Loading...';

    fetch("ajax_cat_content", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            pagelink: slug,
            page: page
        })
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() !== '') {
            document.getElementById('content')
                    .insertAdjacentHTML('beforeend', data);

            // update page
            btn.dataset.page = page;
            btn.disabled = false;
            btn.textContent = 'Load More';
        } else {
            // no more data
            btn.style.display = 'none';
        }
    })
    .catch(() => {
        btn.disabled = false;
        btn.textContent = 'Load More';
    })
    .finally(() => {
        loading = false;
    });
});
</script>

@endsection