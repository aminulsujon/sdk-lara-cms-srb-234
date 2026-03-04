<div class="ncl mb-2 rounded">
    <div class="row">
        <div class="col-5">
            @foreach ($content['upload'] as $item)
                <a href="{{ $content['slug'] }}">
                    <img class="img-fluid rounded-left " src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" alt="{{ $item['name'] }}">  
                </a>
                @break
            @endforeach
        </div>
        <div class="col-7 pl-0">
            <a href="{{ $content->slug }}">{{ $content->name }}</a>
        </div>
    </div>
</div>