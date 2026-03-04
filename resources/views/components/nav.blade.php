@php 
$arr_contenttype = [
    'home'=>'Home',
    'blog'=>'Blog',
    'ads'=>'Advertisement',
    'landing'=>'Landing',
    'page'=>'Page',
    'testimonial'=>'Testimonial'
    ];
@endphp

<ul class="vertical-nav-menu ps-0">
    
    {{-- <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/landing">Landing</a></li> --}}
    <li class="py-2 border-b border-gray-300 d-flex justify-content-between align-items-center">
        <a class="p-2" href="/admin/news">News</a>
        <a class="p-2" href="/admin/news/rundown">Top</a>
        <a class="px-2 font-bold rounded border border-white" href="/admin/news/create">+</a>
    </li>
    <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/tag/3">Category</a></li>
    <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/tag/5">Sections</a></li>
    <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/tag/7">Events</a></li>
    <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/tag/6">Reporters</a></li>
    <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/tag/8">Areas</a></li>
    <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/pagesetting">SEO</a></li>
    {{-- <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/setting">Settings</a></li> --}}
    {{-- <li class="py-2 border-b border-gray-300"><a class="p-2" href="javascript:void();">Contents</a>
        <ul>
            @foreach ($arr_contenttype as $key => $value)
                <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/content?type={{ $key }}">{{ $value }}</a></li>
            @endforeach
        </ul>
    </li> --}}
    
    {{-- <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/ecommerce">E-commerce</a></li> --}}
    {{-- <li class="py-2 border-b border-gray-300"><a class="p-2" href="/admin/upload">Media Server</a></li> --}}
</ul>