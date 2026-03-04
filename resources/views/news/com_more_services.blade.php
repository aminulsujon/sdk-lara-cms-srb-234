<section class="our_services_area section-padding-100-0" id="services">
    <div class="container">
        
        <div class="section-heading text-center">
            <span>More Services</span>
            <h2 class="d-blue bold fadeInUp" data-wow-delay="0.3s">Our Core Services</h2>
            <p class="fadeInUp" data-wow-delay="0.4s">We offer a comprehensive range of digital services designed to empower your business</p>
        </div>
    
        <div class="row">
            @forelse($contents as $content)
            <div class="col-6 col-md-6 col-lg-4 pb-4">
                <!-- Content -->
                <div class="service_single_content v2 text-center wow fadeInUp" data-wow-delay="0.2s">
                    
                    <div class="serv_icon">
                        @if(!empty($content->upload[0]))   
                        @foreach ($content->upload as $item)
                            <a href="{{ $content['slug'] }}"><img src="{{ asset( 'images/uploads/large/'.$item['file']) }}" alt="{{ $item['name'] }}"></a>
                            @break
                        @endforeach
                        @else               
                        @endif  
                    </div>
                    <div class="service-content">
                        <h6 class="d-blue bold"><a href="{{ $content['slug'] }}">{{ $content->name }}</a></h6>
                        <p>{{ $content->subtitle }}</p>
                    </div>
                </div>
            </div>
            @empty

            @endforelse
            
            

        </div>
    </div>
</section>
<div class="clearfix"></div>