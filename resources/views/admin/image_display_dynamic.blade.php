@if(!empty($item['file']))
    <div class="mb-4">
        <img style="max-width:100%" src="{{ asset( 'images/uploads/'.$folder_path.'/'.$item['file']) }}" alt="{{ $item['name'] }}" height="{{ $height ?? 100 }}">  
    </div>
@else  
    @if(!empty($item['url']))
        <div class="mb-4">
            <img style="max-width:100%" src="{{ asset( $item['url']) }}"  alt="{{ $item['name'] }}" height="{{ $height ?? 100 }}">
        </div>
    @endif
@endif