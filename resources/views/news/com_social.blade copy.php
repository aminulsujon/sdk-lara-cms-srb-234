<ul class="header-social">    
    @if(!empty($websettings['cms_facebook']))
        <li>
        <a target="_blank" href="{{ $websettings['cms_facebook'] }}" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M22.675 0h-21.35C.592 0 0 .592 0 1.325v21.351C0 23.408.592 24 1.325 24H12.82v-9.294H9.692v-3.622h3.127V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.099 2.794.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116C23.408 24 24 23.408 24 22.675V1.325C24 .592 23.408 0 22.675 0z"/>
            </svg>
            <span class="d-none">Facebook</span>
        </a>
        </li>
        @endif
        @if(!empty($websettings['cms_twitter']))
        <li>
        <a target="_blank" href="{{ $websettings['cms_twitter'] }}" aria-label="Twitter">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724c-.951.555-2.005.959-3.127 1.184a4.916 4.916 0 0 0-8.384 4.482C7.691 8.095 4.066 6.13 1.64 3.161a4.822 4.822 0 0 0-.666 2.475c0 1.708.869 3.213 2.188 4.096a4.904 4.904 0 0 1-2.228-.616v.062a4.916 4.916 0 0 0 3.946 4.827 4.996 4.996 0 0 1-2.224.085 4.93 4.93 0 0 0 4.604 3.417A9.867 9.867 0 0 1 0 19.54a13.94 13.94 0 0 0 7.548 2.212c9.056 0 14.01-7.496 14.01-13.986 0-.213-.005-.425-.014-.636A9.936 9.936 0 0 0 24 4.557z"/>
            </svg>
        </a>
        </li>
    @endif
    @if(!empty($websettings['cms_instagram']))
        <li>
        <a target="_blank" href="{{ $websettings['cms_instagram'] }}" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M12 2.163c3.204 0 3.584.012 4.849.07 1.366.062 2.633.335 3.608 1.31.975.976 1.248 2.243 1.31 3.609.058 1.265.069 1.645.069 4.849s-.012 3.584-.07 4.849c-.062 1.366-.335 2.633-1.31 3.608-.976.975-2.243 1.248-3.609 1.31-1.265.058-1.645.069-4.849.069s-3.584-.012-4.849-.07c-1.366-.062-2.633-.335-3.608-1.31-.975-.976-1.248-2.243-1.31-3.609C2.175 15.746 2.163 15.366 2.163 12s.012-3.584.07-4.849c.062-1.366.335-2.633 1.31-3.608.976-.975 2.243-1.248 3.609-1.31C8.416 2.175 8.796 2.163 12 2.163M12 0C8.741 0 8.332.013 7.052.072 5.775.131 4.602.443 3.603 1.443 2.604 2.443 2.292 3.616 2.233 4.894.173 6.174.16 6.583.16 12c0 5.418.013 5.827.072 7.106.059 1.278.371 2.451 1.371 3.451 1 1 2.173 1.312 3.451 1.371C8.332 23.987 8.741 24 12 24s3.668-.013 4.948-.072c1.278-.059 2.451-.371 3.451-1.371 1-1 1.312-2.173 1.371-3.451.059-1.279.072-1.688.072-7.106s-.013-5.827-.072-7.106c-.059-1.278-.371-2.451-1.371-3.451C19.399.443 18.226.131 16.948.072 15.668.013 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 6.162 6.162A6.167 6.167 0 0 0 12 5.838zm0 10.162a4 4 0 1 1 4-4 4.005 4.005 0 0 1-4 4zm6.406-11.845a1.44 1.44 0 1 1-1.44-1.44 1.439 1.439 0 0 1 1.44 1.44z"/>
            </svg>
        </a>
        </li>
    @endif
    @if(!empty($websettings['cms_linkedin']))
        <li>
        <a target="_blank" href="{{ $websettings['cms_linkedin'] }}" aria-label="linkedin">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.352V9h3.414v1.561h.049c.476-.9 1.637-1.852 3.37-1.852 3.601 0 4.266 2.371 4.266 5.455v6.288zM5.337 7.433a2.062 2.062 0 1 1 0-4.124 2.062 2.062 0 0 1 0 4.124zM6.814 20.452H3.861V9h2.953v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.226.792 24 1.771 24h20.451C23.2 24 24 23.226 24 22.271V1.729C24 .774 23.2 0 22.222 0z"/>
            </svg>
        </a>
        </li>
    @endif
    @if(!empty($websettings['cms_pinterest']))
        <li>
        <a target="_blank" href="{{ $websettings['cms_pinterest'] }}" aria-label="Pinterest">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M12.004 0C5.373 0 0 5.373 0 12.004c0 5.078 3.163 9.413 7.625 11.169-.105-.948-.199-2.406.041-3.444.217-.932 1.395-5.932 1.395-5.932s-.356-.713-.356-1.767c0-1.656.961-2.894 2.157-2.894 1.018 0 1.508.764 1.508 1.678 0 1.023-.652 2.554-.988 3.973-.283 1.196.6 2.17 1.775 2.17 2.13 0 3.769-2.248 3.769-5.493 0-2.87-2.061-4.88-5.008-4.88-3.41 0-5.415 2.556-5.415 5.202 0 1.031.398 2.139.894 2.74a.36.36 0 0 1 .083.343c-.091.378-.295 1.196-.335 1.362-.052.217-.172.263-.398.158-1.494-.693-2.423-2.87-2.423-4.614 0-3.759 2.727-7.209 7.868-7.209 4.128 0 7.34 2.943 7.34 6.872 0 4.101-2.585 7.403-6.175 7.403-1.206 0-2.34-.626-2.728-1.368l-.743 2.828c-.268 1.029-.994 2.316-1.484 3.104 1.113.344 2.292.53 3.524.53 6.631 0 12.004-5.373 12.004-12.004S18.635 0 12.004 0z"/>
            </svg>
        </a>
        </li>
    @endif
    
    @if(!empty($websettings['cms_youtube']))
        <li>    
        <a target="_blank" href="{{ $websettings['cms_youtube'] }}" aria-label="YouTube">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img" aria-label="YouTube logo">
            <rect width="24" height="16" x="0" y="4" rx="3.2" ry="3.2"/>
            <polygon points="10,9 16,12 10,15" fill="#fff"/>
        </svg>
        </a>
        </li>
    @endif  

    @if(!empty($websettings['cms_whatsapp']))
        <li>
        <a target="_blank" href="{{ $websettings['cms_whatsapp'] }}" aria-label="whatsapp">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M12.004 0C5.373 0 0 5.373 0 12.004c0 5.078 3.163 9.413 7.625 11.169-.105-.948-.199-2.406.041-3.444.217-.932 1.395-5.932 1.395-5.932s-.356-.713-.356-1.767c0-1.656.961-2.894 2.157-2.894 1.018 0 1.508.764 1.508 1.678 0 1.023-.652 2.554-.988 3.973-.283 1.196.6 2.17 1.775 2.17 2.13 0 3.769-2.248 3.769-5.493 0-2.87-2.061-4.88-5.008-4.88-3.41 0-5.415 2.556-5.415 5.202 0 1.031.398 2.139.894 2.74a.36.36 0 0 1 .083.343c-.091.378-.295 1.196-.335 1.362-.052.217-.172.263-.398.158-1.494-.693-2.423-2.87-2.423-4.614 0-3.759 2.727-7.209 7.868-7.209 4.128 0 7.34 2.943 7.34 6.872 0 4.101-2.585 7.403-6.175 7.403-1.206 0-2.34-.626-2.728-1.368l-.743 2.828c-.268 1.029-.994 2.316-1.484 3.104 1.113.344 2.292.53 3.524.53 6.631 0 12.004-5.373 12.004-12.004S18.635 0 12.004 0z"/>
            </svg>
        </a>
        </li>
    @endif
</ul>

<style>
    /* Overlay style */
    #searchOverlay {
      position: fixed;
      inset: 0;
      background: rgba(255, 255, 255, 0.97);
      z-index: 1050;
      display: none;
      overflow-y: auto;
      transition: all 0.3s ease;
    }
    #searchOverlay.active {
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>

<!-- 🔎 Full Screen Search Overlay -->
<div id="searchOverlay">
  <div class="container py-5">
    <div class="bg-white p-4 p-md-5 rounded-4 shadow-lg position-relative">
      
      <!-- Close Button -->
      <button id="closeSearch"
        type="button"
        class="position-absolute top-0 end-0 m-3 btn-light rounded-circle shadow-sm d-flex align-items-center justify-content-center"
        style="width: 40px; height: 40px; transition: all 0.3s ease;top:0;right:0;"
        aria-label="Close">
        ✖
    </button>

      
      <h4 class="mb-4 text-center fw-bold">সংবাদ অনুসন্ধান করুন</h4>

      <form action="{{ url('/search') }}" method="POST" class="row g-3">
        @csrf
        <!-- Search Input -->
        <div class="col-12 mb-4">
            <input type="text" 
                name="q" 
                id="searchQuery" 
                class="form-control form-control-lg" 
                placeholder="আপনার অনুসন্ধান লিখুন...">
        </div>

        <!-- Category -->
        {{-- <div class="col-md-6">
            <select id="category" name="category" class="form-select form-select-lg">
                <option selected value="">সব বিভাগ</option>
                <option value="tech">প্রযুক্তি</option>
                <option value="design">নকশা</option>
                <option value="business">ব্যবসা</option>
                <option value="education">শিক্ষা</option>
            </select>
        </div>

        <!-- Date Range -->
        <div class="col-md-3">
            <input type="date" name="from" id="fromDate" class="form-control form-control-lg">
        </div>
        <div class="col-md-3">
            <input type="date" name="to" id="toDate" class="form-control form-control-lg">
        </div> --}}

        <!-- Submit Button -->
        <div class="col-12 text-center pt-3">
            <button type="submit" class="btn btn-primary btn-lg px-5">
                অনুসন্ধান করুন
            </button>
        </div>
    </form>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->

<script>
  var openSearch = document.getElementById('openSearch');
  var closeSearch = document.getElementById('closeSearch');
  var searchOverlay = document.getElementById('searchOverlay');

  openSearch.addEventListener('click', () => {
    searchOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  });

  closeSearch.addEventListener('click', () => {
    searchOverlay.classList.remove('active');
    document.body.style.overflow = '';
  });
</script>
