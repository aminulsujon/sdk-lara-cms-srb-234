<div class="border mt-4">
    <div class="row align-items-center">
        <div class="col-4 col-md-2">
            @foreach ($content['upload'] as $item)
                <a href="{{ $content['slug'] }}">
                    <img class="img-fluid"
                         src="{{ asset('images/uploads/thumb/'.$item['file']) }}"
                         alt="{{ $item['name'] }}">
                </a>
                @break
            @endforeach
        </div>

        <div class="col-8 col-md-10">
            <h4 class="mb-1">
                <a href="{{ $content->slug }}">{{ $content->name }}</a>
            </h4>

            <div class="d-none d-md-flex align-items-center text-muted">
                <svg fill="#ddd" width="20" height="20" viewBox="0 0 32 32">
                    <path d="M0 16q0-3.232..."></path>
                </svg>
                <span class="ms-2">
                    <time datetime="{{ $content->created_at }}">
                        {{ enToBnDate(date('d M Y h:i A', strtotime($content->created_at))) }}
                    </time>
                </span>
            </div>
        </div>
    </div>
</div>
