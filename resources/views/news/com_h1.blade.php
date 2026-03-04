<div class="bg-white border-bottom">
    <div class="container py-2">
        <div class="w-100">
            <div class="row">
                <div class="col-3">
                    <div class="mb-2">
                        <a href="javascript:void(0);" id="openSearch" class="text-dark pl-2">
                            <!-- Outline search icon (24x24) -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" role="img">
                                <title>Search</title>
                                <circle cx="11" cy="11" r="7"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col-6 text-center">
                    <a href="{{ $websettings['cms_url'] }}">
                        <img src="images/logo.jpg" alt="logo" class="img-fluid logo-gfx">
                        <span class="d-none">{{ $websettings['cms_sitename'] }}</span>
                    </a>
                </div>
                <div class="col-3 d-none d-md-block">
                    @include($websettings['cms_layout'].'.com_social')
                </div>
            </div>
            
        </div>
    </div>
</div>
@include($websettings['cms_layout'].'.com_search')