<div class="border p-2 mb-2 bg-light">
    <legend>Uploaded Video Thumb Image</legend>
    <div class="row">
        <div class="col-md-4">
            <div class="position-relative form-group">
                <div class="border p-2" >
                    @include('admin.image_display_dynamic',['item'=>$file,'folder_path'=>'small'])
                </div>
            </div>
         </div>
        <div class="col-md-8" >
            <input type="hidden" name="image_remove_id[]" id="image_remove_id{{ $file['id'] }}">
            <div id="image_remove_warning{{ $file['id'] }}" style="display:none" class="text-danger">
                <span class="text-warning"><b>Warning:</b></span> This image will be removed after submit this form.
                <a onclick="cancelImageRemoval({{ $file['id'] }})" href="javascript:void(0);" class="btn btn-danger">Cancel</a>
            </div>
            <a id="image_remove_button{{$file['id']}}" onclick="setImageRemoval({{$file['id']}})" href="javascript:void(0);" class="btn btn-danger">Remove Image</a>
            <div class="position-relative form-group my-1">
                <b>Image name:</b> {{$file['name'] ?? ''}}
            </div>
            <div class="position-relative form-group my-1">
                <b>Image caption:</b> {{$file['caption'] ?? ''}}
            </div>
            <div class="position-relative form-group my-1">
                <b>Image description:</b> {{$file['description'] ?? ''}}
            </div>
         </div>
     </div>
</div>