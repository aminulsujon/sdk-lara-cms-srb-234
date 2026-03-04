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

<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            @include('admin/card_head',[
                'title'=>'Create New Service',
                'info'=>'',
                'links'=>[
                    0=>['text'=>'Service Management','link'=>'/admin/service'],
                    ]  
                ])
                <div class="card-body">
                <form id="myForm" action="{{URL::to('admin/service')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.form_name')
                    @include('admin.form_slug')
                    <div class="mb-2 grid grid-cols-6 gap-2">
                        <label for="summary" class="">Page Summary</label>
                        <input name="summary" id="summary" type="text" class="form-control">
                    </div>                   
                    

<!-- Include stylesheet -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

<label>Details</label>
<div id="editor" type="text" class="border form-control"></div>
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
                    @include('admin.form_meta')
                    @include('admin.form_image_upload_single')
                    <div class="flex">@include('admin.form_status')</div> 
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
@endsection