@foreach($categories as $tag)
    <div title="Set tag {{$tag->title}}" class="d-inline-block mb-2 mr-2 border py-1 px-2">
        <label class="catcontainer">{{$tag->title}}
            <input name="tag[]" value='{{$tag->id}}' type="checkbox" @if(in_array($tag->id, old('tags', $content->tags->pluck('id')->toArray()))) checked @endif >
            <span class="checkmark"></span>
        </label>
    </div>
@endforeach

