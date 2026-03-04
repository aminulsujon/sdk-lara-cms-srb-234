
<div class="border p-2 mb-2 bg-light">
    <legend class="h3">{{$value}}</legend>
    <div class="row">
        <div class="col-md-9" >
            <div class="position-relative form-group">
                <label class="">Name</label>
                <input name="member[{{$i}}][name]" type="text" class="form-control">
                <input name="member[{{$i}}][post]" type="hidden" class="form-control" value="{{$i}}">
            </div>
            <div class="position-relative form-group">
                <label class="">Slug</label>
                <input name="member[{{$i}}][slug]" id="slug{{$i}}" type="text" class="slug-autocheckup form-control">
                <span style="display:none" id="slugNotice{{$i}}" class="text-danger">This slug already exists</span>
            </div>
            <div class="position-relative form-group">
                <div class="text-danger mb-2"><b>Image Must be .Webp Format. width: 500px, height: 400px</b> </div>
                <input name="file[{{$i}}][item]" id="" type="file" class="form-control pb-2">
            </div>
            <!-- <div class="position-relative form-group">
                <label class="">Designation</label>
                <input name="designation" type="text" class="form-control">
            </div>
            <div class="position-relative form-group">
                <label class="">Profile Photo</label>
                <input name="profilePhoto" type="text" class="form-control">
            </div>
            <div class="position-relative form-group">
                <label class="">Contact</label>
                <input name="contact" type="text" class="form-control">
            </div>
            <div class="position-relative form-group">
                <label class="">Email</label>
                <input name="email" type="email" class="form-control">
            </div>
            <div class="position-relative form-group">
                <label class="">Website</label>
                <input name="website" type="text" class="form-control">
            </div>
            <div class="position-relative form-group">
                @include('admin.form_ckeditor',['name'=>'about','label'=>'About me'])
            </div>
            <div class="position-relative form-group">
                @include('admin.form_bloodgroup',[])
            </div> -->
        </div>
        
        </div>
    </div>
</div>
