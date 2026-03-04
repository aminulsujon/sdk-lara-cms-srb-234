<div class="d-none d-md-block bg-white border-bottom">
    <div class="container py-2">
        <div class="w-100">
            <div class="d-flex justify-content-between align-items-center">

                <!-- Left Info -->
                <div class="d-flex align-items-center">
                    <ul class="d-flex align-items-center mb-0">
                        <li class="d-flex align-items-center p-2 me-3">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" class="me-1" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 
                                        0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 
                                        2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                            কক্সবাজার
                        </li>

                        <li class="d-flex align-items-center">
                            <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" class="me-1" viewBox="0 0 24 24">
                                <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 
                                        0-2 .9-2 2v14c0 1.1.9 2 2 
                                        2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 
                                        16H5V9h14v11z"/>
                            </svg>
                            {{ enToBnDateTime(date('l, d M Y')) }}
                        </li>
                    </ul>
                </div>

                <!-- Logo -->
                <div class="d-flex justify-content-center">
                    <a href="{{ $websettings['cms_url'] }}" class="d-flex align-items-center text-decoration-none">
                        <img src="images/logo.jpg" alt="logo" class="img-fluid" style="height: 64px;">
                        <span class="d-none">{{ $websettings['cms_sitename'] }}</span>
                    </a>
                </div>

                <!-- Right Info -->
                <div>
                    @include($websettings['cms_layout'].'.com_social')
                </div>
            </div>
        </div>
    </div>
</div>
