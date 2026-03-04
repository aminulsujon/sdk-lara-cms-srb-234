@if(!empty($trending->Contents))
<div class="row">
    <div class="col-lg-12">
        <div class="trending-tittle">
            <strong>এখন ট্রেন্ডিং</strong>
            <!-- <p>Rem ipsum dolor sit amet, consectetur adipisicing elit.</p> -->
            <div class="trending-animated">
                <ul id="js-news" class="js-hidden">
                    @foreach($trending->Contents->take(10) as $content)
                        <li class="news-item"><a href="{{ $content->slug }}"> {{ $content->name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif