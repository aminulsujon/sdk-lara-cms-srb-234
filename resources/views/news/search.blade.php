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
            <h1>অনুসন্ধানের বিষয়: {{ $query ?? 'অনুসন্ধানের বিষয় ' }}
                <svg fill="#b40000" version="1.1" id="editSearch" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                    width="30px" height="30px" viewBox="0 0 494.936 494.936"
                    xml:space="preserve">
                <g>
                    <g>
                        <path d="M389.844,182.85c-6.743,0-12.21,5.467-12.21,12.21v222.968c0,23.562-19.174,42.735-42.736,42.735H67.157
                            c-23.562,0-42.736-19.174-42.736-42.735V150.285c0-23.562,19.174-42.735,42.736-42.735h267.741c6.743,0,12.21-5.467,12.21-12.21
                            s-5.467-12.21-12.21-12.21H67.157C30.126,83.13,0,113.255,0,150.285v267.743c0,37.029,30.126,67.155,67.157,67.155h267.741
                            c37.03,0,67.156-30.126,67.156-67.155V195.061C402.054,188.318,396.587,182.85,389.844,182.85z"/>
                        <path d="M483.876,20.791c-14.72-14.72-38.669-14.714-53.377,0L221.352,229.944c-0.28,0.28-3.434,3.559-4.251,5.396l-28.963,65.069
                            c-2.057,4.619-1.056,10.027,2.521,13.6c2.337,2.336,5.461,3.576,8.639,3.576c1.675,0,3.362-0.346,4.96-1.057l65.07-28.963
                            c1.83-0.815,5.114-3.97,5.396-4.25L483.876,74.169c7.131-7.131,11.06-16.61,11.06-26.692
                            C494.936,37.396,491.007,27.915,483.876,20.791z M466.61,56.897L257.457,266.05c-0.035,0.036-0.055,0.078-0.089,0.107
                            l-33.989,15.131L238.51,247.3c0.03-0.036,0.071-0.055,0.107-0.09L447.765,38.058c5.038-5.039,13.819-5.033,18.846,0.005
                            c2.518,2.51,3.905,5.855,3.905,9.414C470.516,51.036,469.127,54.38,466.61,56.897z"/>
                    </g>
                </g>
                </svg>
            </h1>
        </div>
        @foreach($contents as $content)
            @if($loop->iteration % 7 === 0)
                @include($websettings['cms_layout'].'.middle')
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
    </div>
    <!--Recent Articles End -->

    

        <!--Start pagination -->
        <div class="d-flex justify-content-center gap-2 mt-4">
            @foreach ($contents->getUrlRange(1, $contents->lastPage()) as $page => $url)
                <button 
                    type="button" 
                    class="btn-sm {{ $page == $contents->currentPage() ? 'btn-secondary' : 'btn-primary' }} page-btn mx-2"
                    data-page="{{ $page }}">
                    {{ $page }}
                </button>
            @endforeach
        </div>
    <!-- End pagination  -->
    </main>
    <!-- Hidden form for pagination POST -->
    <form id="paginationForm" method="POST" action="search" class="d-none">
        @csrf
        <input type="hidden" name="q" value="{{ request('q') }}">
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="hidden" name="from" value="{{ request('from') }}">
        <input type="hidden" name="to" value="{{ request('to') }}">
        <input type="hidden" name="page" id="pageField">
    </form>
<script>
    document.querySelectorAll('.page-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('pageField').value = this.dataset.page;
            document.getElementById('paginationForm').submit();
        });
    });
</script>

<script>
  const editSearch = document.getElementById('editSearch');
  const searchQuery = document.getElementById('searchQuery');

  editSearch.addEventListener('click', () => {
    searchOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
    searchQuery.value = "{{ $query ?? '' }}";
    searchQuery.focus();
  });

</script>
@endsection