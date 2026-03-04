<a href="{{ $content->slug }}" class="w-100 link-img text-decoration-none d-inline-flex justify-content-between align-items-center pb-2 mb-2 ">
    <span class="fw-bold">{{ $content->name }}</span>
    @if(!empty($content['upload'][0]['file']))
        <img 
            src="{{ asset('images/uploads/thumb/'.$content['upload'][0]['file']) }}"
            alt="{{ $content['upload'][0]['file'] }}"
            width="200"
            height="133"
        >
    @endif
</a>