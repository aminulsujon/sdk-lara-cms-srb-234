
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
    document.querySelector('#searchQuery').focus();
  });

  closeSearch.addEventListener('click', () => {
    searchOverlay.classList.remove('active');
    document.body.style.overflow = '';
  });
</script>
