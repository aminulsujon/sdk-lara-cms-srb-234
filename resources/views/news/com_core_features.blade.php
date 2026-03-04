<section class="how section-padding-100-70 relative map-bg map-before">

    <div class="container">

        <div class="section-heading text-center">
            <span>Awesome Features for Business</span>
            <h2 class="wow fadeInUp d-blue bold" data-wow-delay="0.3s">Our core Features</h2>
            <p class="wow fadeInUp" data-wow-delay="0.4s">Our software and IT solutions are designed to empower businesses with innovative features that drive efficiency, growth, and success. Key features include:</p>
        </div>
        <div class="row">
            @foreach ($features as $content)
            <div class="col-6 col-md-6 col-lg-3 mb-4">
                <!-- Content -->
                <div class="service_single_content box-shadow text-center wow fadeInUp" data-wow-delay="0.2s">
                    <!-- Icon -->
                    <div class="how_icon">
                        @if(!empty($content->upload[0]))   
                        @foreach ($content->upload as $item)
                            <a href="{{ $content['slug'] }}"><img src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" class="colored-icon" alt="{{ $item['name'] }}"></a>
                            @break
                        @endforeach
                        @else               
                        @endif  
                    </div>
                    <h6>{{ $content['name'] }}</h6>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<div class="clearfix"></div>