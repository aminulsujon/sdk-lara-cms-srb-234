<!-- Photo Gallery Section -->
<section class="container mb-5">
    <div class="section-tittle mb-30">
        <h3>
            <a href="photos">
                <span>ফটো গ্যালারি</span>
            </a>
        </h3>
    </div>

    <div class="row">
        @php
        // dd($home_photos);
        if(!empty($home_photos) && count($home_photos['Contents']) > 0){
            $photos = $home_photos['Contents'];
            // dd($photos);
        }else{
            // return;
        }
        @endphp
        
        @if(!empty($photos))
        <!-- Main Photo -->
        <div class="col-md-7 mb-4">
           
            <div class="shadow rounded">
                @foreach ($photos[0]['upload'] as $item)
                    <a href="{{ $photos[0]['slug'] }}">
                        <img class="img-fluid" src="{{ asset( 'images/uploads/large/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                    </a>
                    @break
                @endforeach
            </div>

            <!-- Photo Title -->
            <div class="mt-3">
                <h4 class="fw-bold" id="mainPhotoTitle">
                    <a href="{{ $photos[0]['slug'] }}">{{ $photos[0]['name'] }}</a>
                </h4>
            </div>
            
        </div>

        <!-- Related Photos Sidebar -->
        <div class="col-md-5 mt-4 mt-sm-0">
            <div class="row">
                @foreach($photos->skip(1)->take(4) as $content)
                    <div class="col-6 col-md-6 mb-4">
                        <div class="me-3 mb-2" style="overflow: hidden;">
                            @foreach ($content['upload'] as $item)
                                <a href="{{ $content['slug'] }}">
                                    <img class="img-fluid" src="{{ asset( 'images/uploads/small/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                                </a>
                                @break
                            @endforeach
                        </div>
                        <a href="{{ $content['slug'] }}">{{ $content['name'] }}</a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Script for dynamic photo switching -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const mainPhoto = document.getElementById("mainPhoto");
    const mainTitle = document.getElementById("mainPhotoTitle");

    document.querySelectorAll(".photo-thumb").forEach(item => {
      item.addEventListener("click", function () {
        const photoSrc = this.getAttribute("data-photo");
        const photoTitle = this.getAttribute("data-title");

        // Update main photo and title
        mainPhoto.src = photoSrc;
        mainTitle.textContent = photoTitle;

        // Optional smooth scroll
        mainPhoto.scrollIntoView({ behavior: "smooth", block: "start" });
      });
    });
  });
</script>
