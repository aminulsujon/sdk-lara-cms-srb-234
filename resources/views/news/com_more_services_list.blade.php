<section class="our_services_area section-padding-100-0" id="services">
    <div class="container">
        
        <div class="section-heading text-center">
            <span>More Services</span>
            <h2 class="d-blue bold fadeInUp" data-wow-delay="0.3s">Our Core Services</h2>
            <p class="fadeInUp" data-wow-delay="0.4s">We offer a comprehensive range of digital services designed to empower your business</p>
        </div>
        @if(!empty($services))
        <div class="row">
            @forelse($services as $content)
            <div class="col-6 col-md-6 col-lg-4 pb-4">
                <!-- Content -->
                <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.2s">
                    <div class="service-content">
                        <h6 class="d-blue bold"><a href="{{ $content['slug'] }}">{{ $content->name }}</a></h6>
                        <p>{{ $content->subtitle }}</p>
                    </div>
                </div>
            </div>
            @empty

            @endforelse
            
            

        </div>
        @endif
    </div>
</section>
<div class="clearfix"></div>