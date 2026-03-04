@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'Edit testimonial',
            'info'=>'Edit your testimonial from this page, image size should be 900x600px',
            'links'=>[
                0=>['text'=>'testimonial Management','link'=>'/admin/testimonial'],
                1=>['text'=>'Create New testimonial','link'=>'/admin/testimonial/create'],
                ]  
            ])
    <div class="card-body">
    <form id="myForm" name="myForm" action="{{URL::to('admin/testimonial/'.$content->id)}}"  method="post" enctype="multipart/form-data">    
    @csrf
    @method('PATCH')
    <div class="position-relative form-group">
        <label for="exampleEmail" class="">Name</label>
        <input name="name" required="required" type="text" class="form-control" value="{{ $content->name }}">
    </div>
    @include('admin.form_slug_edit',['slug'=>$content->slug])
    {{-- {{ $content->details }} --}}
    {{-- <div class="position-relative form-group">
        @include('admin.form_ckeditor',['label'=>'Details','name'=>'details','value'=>  $content->details])
    </div> --}}
    {{-- @include('admin.form_editor',['details'=>$content->details]) --}}
    <div class="position-relative form-group">
        <label for="exampleEmail" class="">Summary</label>
        <input name="summary" required="required" type="text" class="form-control" value="{{ $content->summary }}">
    </div>
    
    @include('admin/form_status',['value'=>$content->status])
    @include('admin/button_submit')
    </div>
  
    </form>
    </div>
    </div>
</div>
</div>

<style>
.close{
    line-height: 0.3;
    font-weight: normal;
    color: black;
    opacity: 1;
    margin-left: 10px;
}
.disabled{color:#ddd}
.disabled.badge-info{background:#eee}
</style>

@endsection

@section('page_script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('admin.script_image_edit')
    @include('admin.script_image_edit_multiple')
@endsection