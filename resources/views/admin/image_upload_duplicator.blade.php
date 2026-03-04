<div id="duplicator" style="display:none">
    <div class="doplicated-fields border p-2 form-group bg-light">
        <div class="mb-2 text-danger"> Image Size Must Be 1080px X 1080px</div>
        <input name="file[]" required="required" type="file" class="form-control mb-2">
        <input name="name[]" required="required" type="text" placeholder="{{$name??'Image Name'}}" class="form-control mb-2">
        <textarea name="caption[]" placeholder="{{$caption??'Image Caption'}}" class="form-control"></textarea>
    </div>
</div>