@foreach($tags as $tag)
    <div class="item">
        <h4>{{ $tag->title }}</h4>
        <p>{{ $tag->description }}</p>
    </div>
@endforeach