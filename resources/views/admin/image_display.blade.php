<div class="border mb-2">
    <div class="row">
        <div class="col-3"><img src="{{ asset($galleryImage->file ?? '') }}" class="img-fluid border-right p-2"></div>
        <div class="col-9"><h6 class="mt-2"><b>{{$galleryImage->name}}</b></h6>
            {{$galleryImage->caption}}</div>
    </div>
</div>