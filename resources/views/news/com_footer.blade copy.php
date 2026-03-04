<footer>
  <div class="footerbg d-print-none">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-12 border-right-inner-forFooter">
          <div class="DFLogo mb-4">
            <a href="/">
              <img src="images/logo.jpg" alt="" width="300" class="p-2 rounded bg-white">
            </a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 border-right-inner-forFooter">
          <div class="Info">
            <span>Address:</span> Hotel Kohinoor (Ground Floor), Shaheed Sarani, Cox's Bazar 4700.<br>
            <a href="mailto:dailycoxsbazar@yahoo.com"><span>E-mail:</span> dailycoxsbazar@yahoo.com</a>
            <br>
           <span>Tel:</span> 
            <a href="tel:034162794">034162794</a>, 
            <a href="tel:01816362741">01816362741</a>, 
            <a href="tel:01819345775">01819345775</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12">
          <div class="address text-cener">
            <h5><span>প্রতিষ্ঠাতা সম্পাদক:</span> মরহুম মোহাম্মদ নূরুল ইসলাম</h5>
            <h5><span>সম্পাদক:</span> ফাতেমা জাহান</h5>
            <h5><span>পরিচালনা সম্পাদক:</span> মোহাম্মদ মুজিবুল ইসলাম</h5>
            <h5><span>বার্তা সম্পাদক:</span> মোহাম্মদ নজিবুল ইসলাম</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-black mb-0">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <p>
            @if(!empty($websettings['cms_web_copyright'])) {{ $websettings['cms_web_copyright'] }} @else All rights reserved @endif | 
            @if(!empty($websettings['cms_developer_credit']))
                {!! $websettings['cms_developer_credit'] !!}
            @endif
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>
<style>
  .footerbg {
    background: #d9d9d9;
    color: #333;
    padding: 30px 0;
  }
  .bg-black{
    background: #000;
    color: #fff;
    padding: 10px 0;
  }
  .bg-black p,.bg-black a{
    color: #fff;
  }
</style>