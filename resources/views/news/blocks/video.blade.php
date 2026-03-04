<!-- News Video Section (YouTube style simplified) -->
<section class="container mb-5">
    <div class="section-tittle mb-30">
            <h3>
                <a href="videos"><span>ভিডিও</span></a>
            </h3>
        </div>
  <div class="row">

    <!-- Main Video & Details -->
    <div class="col-md-12 mb-4">
        @if(!empty($home_videos))
          <!-- Main Video -->
          <div class="ratio ratio-16x9 shadow rounded">
            <iframe 
              id="mainVideo"
              src="https://www.youtube.com/embed/{{ $home_videos[0]->youtubevideo }}" 
              title="{{ $home_videos[0]->name }}"
              width="100%" height="400px"
              allowfullscreen>
            </iframe>
          </div>
        @endif
    </div>
    <div class="col-md-5 mt-4 mt-sm-0">
          <!-- Video Title -->
          <div class="mt-3">
            
            <h4 class="fw-bold" id="mainVideoTitle">
              <a href="javascript:void(0);" 
              class="mt-4 video-thumb text-dark text-decoration-none"
              data-video="{{ $home_videos[0]->youtubevideo }}"
              data-title="{{ $home_videos[0]->name }}">{{ $home_videos[0]->name }}
            </a></h4>
            <span>{{ $home_videos[0]->summary }}</span>
          </div>
    </div>

    <!-- Related Videos (sidebar) -->
    <div class="col-md-7 mt-4 mt-sm-0">
      <div class="row mb-3">
        @if(!empty($home_videos))
        @foreach(array_slice($home_videos, 1, 4) as $video)
          <div class="col-md-3">
            <a href="javascript:void(0);" 
              class="mb-4 video-thumb d-block"
              data-video="{{ $video->youtubevideo }}"
              data-title="{{ $video->name }}">
              <img src="https://img.youtube.com/vi/{{ $video->youtubevideo }}/mqdefault.jpg" 
                  class="rounded shadow-sm me-3" 
                  alt="{{ $video->name }}" 
                  style="width: 150px; height: auto;">
            </a>
            <a href="javascript:void(0);" 
              class="mt-4 video-thumb text-dark text-decoration-none"
              data-video="{{ $video->youtubevideo }}"
              data-title="{{ $video->name }}">{{ $video->name }}
            </a>
          </div>
        @endforeach
        @endif
      </div>
    </div>
    
  </div>
</section>

<!-- Script for dynamic video switching -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const mainVideo = document.getElementById("mainVideo");
    const mainTitle = document.getElementById("mainVideoTitle");

    document.querySelectorAll(".video-thumb").forEach(item => {
      item.addEventListener("click", function () {
        const videoId = this.getAttribute("data-video");
        const title = this.getAttribute("data-title");

        // Update iframe and title
        mainVideo.src = "https://www.youtube.com/embed/" + videoId;
        mainTitle.textContent = title;

        // Smooth scroll to video (optional)
        mainVideo.scrollIntoView({ behavior: "smooth", block: "start" });
      });
    });
  });
</script>
