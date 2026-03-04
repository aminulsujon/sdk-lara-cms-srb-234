<div class="position-relative form-group">
    <label class="">Page H1</label>
    <input name="meta_heading" type="text" class="form-control" value="{{ $heading ?? '' }}">
</div>
<div class="position-relative form-group">
    <label class="">Meta Title</label>
    <input name="meta_title" type="text" class="form-control" value="{{ $meta_title ?? '' }}">
</div>
<div class="position-relative form-group">
    <label class="">Meta Keywords</label>
    <input name="meta_keywords" type="text" class="form-control" value="{{ $keyword ?? '' }}">
</div>
@include('admin.form_textarea',['label'=>'Meta Description','name'=>'meta_description','value'=>$meta_description ?? ''])
<div class="position-relative form-group hidden">
    <label class="">Robots Text</label>
    <input name="meta_robots" type="text" class="form-control" value="{{ $meta_robots ?? '' }}">
</div>
<div class="position-relative form-group hidden">
    <label class="">Canonical URL</label>
    <input name="meta_canonical" type="text" class="form-control" value="{{ $meta_canonical ?? '' }}">
</div>
<div class="position-relative form-group hidden">
    <label class="">Share Image URL</label>
    <input name="meta_image" type="text" class="form-control" value="{{ $meta_image ?? '' }}">
</div>