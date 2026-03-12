<footer class="mt-4">
  <div class="footerbg d-print-none">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-5 col-12 border-right-inner-forFooter">
          <div class="DFLogo">
            <a href="/">
              <img src="images/sorob.png" alt="" width="100" class="p-2 rounded bg-white">
            </a>
          </div>
        </div>
        <div class="col-lg-5 col-md-5 col-12 border-right-inner-forFooter">
          <h5 class="font-weight-bold">যোগাযোগ</h5>
          <div class="Info">
            @if(!empty($websettings['cms_address']))
            <div>{!! $websettings['cms_address'] ?? '' !!}, </div>
            @endif
            @if(!empty($websettings['cms_phone']))
            <div>ফোন: {{ $websettings['cms_phone'] }}</div>
            @endif
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-12 smm">
          <h5 class="text-right">অনুসরণ করুন</h5>
          <div class="address">
            @include($websettings['cms_layout'].'.com_social_footer')
          </div>
        </div>
      </div>
    </div>
    <div class="editorial mt-2">
        @if(!empty($websettings['cms_footer_text'])) {{ $websettings['cms_footer_text'] }} @endif
    </div>
  </div>
  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <p>
            @if(!empty($websettings['cms_web_copyright'])) {{ $websettings['cms_web_copyright'] }} @else All rights reserved @endif
          </p>
        </div>
        @if(!empty($websettings['cms_developer_credit']))
          <div class="col-sm-12 text-center dev-credit">
            {!! $websettings['cms_developer_credit'] !!}
          </div>
        @endif
        
      </div>
    </div>
  </div>
</footer>