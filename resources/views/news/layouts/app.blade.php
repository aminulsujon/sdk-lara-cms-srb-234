<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="images/favicon.ico">

    @yield('social')

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ticker-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css?v='.now()->format('Y-m-d-H-i-s')) }}">

    <!-- Responsive Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @include($websettings['cms_layout'].'.layouts.script_body')
    @include($websettings['cms_layout'].'.layouts.script_google')
    @include($websettings['cms_layout'].'.layouts.script_pixel')

      <style>
        svg{
            width: 30px;
        }
        .google-auto-placed{display: none}
      </style> 
     @include($websettings['cms_layout'].'.layouts.script_header')

</head>

<body class="light-version">
    @include($websettings['cms_layout'].'.layouts.script_body')
    @php
    function enToBnDateTime($datetime){
        $en = ['0','1','2','3','4','5','6','7','8','9','AM','PM','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯','এএম','পিএম','রবিবার','সোমবার','মঙ্গলবার','বুধবার','বৃহস্পতিবার','শুক্রবার','শনিবার','জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'];
        return str_replace($en, $bn, $datetime);
    }
    @endphp
    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                @if(!empty($websettings['cms_header1']))
                  @include($websettings['cms_layout'].'.com_h1')
                @endif
                
                @if(!empty($websettings['cms_header2']))
                  @include($websettings['cms_layout'].'.com_h2')
                @endif
                
                @if(!empty($websettings['cms_header3']))
                  @include($websettings['cms_layout'].'.com_h3')
                @endif
            </div>
       </div>
        <!-- Header End -->
    </header>

    <!-- Trending Area Start -->
    
    @if (!empty($websettings['cms_news_ticker_status']))
    <div class="trending-area fix mt-4">
      <div class="container">
        <div class="trending-main">
            @include($websettings['cms_layout'].'.com_trending')
          </div>
      </div>
    </div>
    @endif

    @include($websettings['cms_layout'].'.ads.header')

    @yield('content')

    @include($websettings['cms_layout'].'.ads.footer')
    
    @include($websettings['cms_layout'].'.com_footer')

    <!-- All JS Custom Plugins Link Here here -->
    <script src="js/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/slick.min.js"></script>
    <!-- Date Picker -->
    <script src="js/gijgo.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="js/wow.min.js"></script>
    <script src="js/animated.headline.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>

    <!-- Breaking New Pluging -->
    <script src="js/jquery.ticker.js"></script>
    <script src="js/site.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="js/jquery.scrollUp.min.js"></script>
    {{-- <script src="js/jquery.nice-select.min.js"></script> --}}
    <script src="js/jquery.sticky.js"></script>
    
    <!-- contact js -->
    <script src="js/contact.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    @include($websettings['cms_layout'].'.layouts.script_footer')
</body>
</html>