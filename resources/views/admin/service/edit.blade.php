@extends('layouts.app')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
// dd($content);
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card" style="padding-bottom:200px">
            @include('admin/card_head',[
                'title'=>'Create New Service',
                'info'=>'Create and manage services',
                'links'=>[
                    0=>['text'=>'Service Management','link'=>'/admin/service'],
                    ]  
                ])
                <div class="card-body">
                <form id="myForm" action="{{URL::to('admin/service/'.$content->id)}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="position-relative form-group">
                        <label for="title" class="">Page Title</label>
                        <input name="name" type="text" class="form-control" value="{{ $content->name }}">
                    </div>
                    <div class="position-relative form-group">
                        <label for="title" class="">Page Slug</label>
                        <input name="slug" type="text" class="form-control" value="{{ $content->slug }}">
                    </div>
                    <input name="oldslug" type="hidden" class="form-control" value="{{ $content->slug }}">
                    <div class="position-relative form-group">
                        <label for="summary" class="">Page Summary</label>
                        <input name="summary" id="summary" type="text" class="form-control" value="{{ $content->summary }}">
                    </div>                   
                    
                     
<!-- Editor start -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

<label>Details</label>
<div id="editor" type="text" class="border form-control">{!! $content->details !!}</div>
<input type="hidden" name="details" id="details">

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<br>

<!-- Initialize Quill editor -->
<script>
    const toolbarOptions = [
['bold', 'italic', 'underline', 'strike'],        // toggled buttons
['blockquote', 'code-block'],
['link', 'image', 'video', 'formula'],

[{ 'header': 1 }, { 'header': 2 }],               // custom button values
[{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
[{ 'direction': 'rtl' }],                         // text direction

[{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
[{ 'header': [1, 2, 3, 4, 5, 6, false] }],

[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
[{ 'font': [] }],
[{ 'align': [] }],

['clean']                                         // remove formatting button
];
const quill = new Quill('#editor', {
modules: {
    toolbar: toolbarOptions
},
theme: 'snow'
});
</script>
<script>
document.getElementById('myForm').addEventListener('submit', function (e) {
    const divContent = document.getElementById('editor').innerHTML; // or innerHTML
    document.getElementById('details').value = divContent;
});
</script>
<!-- Editor end -->
                    
                    @if(!empty($content->upload[0]))   
                    <div id="prevUploads">      
                        @foreach($content->upload as $galleryImage)  
                            @include('admin.form_image_display_multiple',['file'=>$galleryImage])
                        @endforeach
                    </div>
                    @else               
                    @endif      
                    @include('admin.form_image_upload_multiple')
                    
                    
                    @include('admin.form_meta',[
                        'heading'=>$content->meta_heading,
                        'keyword'=>$content->meta_keywords,
                        'meta_title'=>$content->meta_title,
                        'meta_description'=>$content->meta_description,
                        'meta_robots'=>$content->meta_robots,
                        'meta_canonical'=>$content->meta_canonical,
                        'meta_image'=>$content->meta_image,
                        ])
                    @include('admin.form_status',['value'=>$content->status])
                    @include('admin.button_submit')
                </form> 
            </div>
        </div>
    </div>
</div>
    
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
