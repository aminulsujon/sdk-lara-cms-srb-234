<div class="p-2">
    <div class="flex justify-between bd-gray-100 mb-2 border-b pb-2">
        <div>
            <h5 class="card-title dark:text-white">
                @include('admin/button_back_icon')
                {{$title}}
            </h5>
            <p>{{$info}}</p>
        </div>  
        <div>
            @if(!empty($links))
                @foreach($links as $key => $value)
                <a class="{{$value['class'] ?? 'border p-1 rounded bg-gray-100'}}" href="{{$value['link']}}">{{$value['text']}}</a>
                @endforeach
            @endif
            @include('admin/button_back')
        </div>
    </div>
</div>