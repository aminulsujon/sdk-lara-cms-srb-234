@if(!empty($websettings['cms_ads_status']))
    <div class="text-center my-3 d-none d-md-block">
    @include('blog.ads.728x90',['width'=>728,'height'=>90,'position'=>'Header','text'=>'Advertisment 728x90'])
    </div>
    <div class="text-center my-3 d-block d-md-none">
    @include('blog.ads.320x100',['width'=>320,'height'=>100,'position'=>'Header','text'=>'Advertisment 320x100'])
    </div>
@endif