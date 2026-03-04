<a href="{{ $content->slug }}" 
    class="d-block news-card news-card-transparent ">
    @if(!empty($content['upload'][0]['file']))
        @include('clip.img',[
            'filename'=>$content['upload'][0]['file'],
            'alt'=>$content->name,
            'width'=>'200',
            'height'=>'150'
        ])
    @endif
    <span class="news-card-body news-card-body-transparent d-block text-left">{{ $content->name }}</span>
</a>