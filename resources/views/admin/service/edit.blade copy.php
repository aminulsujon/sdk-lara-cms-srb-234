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
        <div class="main-card mb-3 card">
            @include('admin/card_head',[
                'title'=>'Create New Page',
                'info'=>'Create and manage Pages of Your Name',
                'links'=>[
                    0=>['text'=>'Page Management','link'=>'/admin/page'],
                    ]  
                ])
                <div class="card-body">
                <form class="" action="{{URL::to('admin/page/'.$content->id)}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="position-relative form-group">
                        <label for="title" class="">Page Title</label>
                        <input name="name" type="text" class="form-control" value="{{ $content->name }}">
                    </div>
                    {{-- @include('admin/form_slug_edit',['slug'=>$content->slug])  --}}
                    <input name="slug" type="hidden" class="form-control" value="{{ $content->slug }}">
                    <div class="position-relative form-group">
                        <label for="summary" class="">Page Summary</label>
                        <input name="summary" id="summary" type="text" class="form-control" value="{{ $content->summary }}">
                    </div>                   
                    @include('admin.form_ckeditor',['name'=>'details','label'=>'About the new Page','value'=>$content->description])                  
                    <br>
                    @if(!empty($content->upload[0]))   
                    <div id="prevUploads">      
                        @foreach($content->upload as $galleryImage)  
                            @include('admin.form_image_display_multiple',['file'=>$galleryImage])
                        @endforeach
                    </div>
                    @else               
                    @endif      
                    <div id="duplicated">
                    </div>
                    <span id="more-image-button" class="btn btn-success mt-3 mb-3" onclick="duplicate()">Add Another Image</span>      
                    <br> 
                    
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

<div id="duplicator" style="display: none">
    @include('admin.form_image_upload_multiple')
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

@section('script_footer')
    <!-- This section will be added to js file generated name="file[0]-->
    <script>
        var imgCount = 0
        function duplicate() {
            var numItems = $('.doplicated-fields').length
            if(numItems<10){
                var text = $("#duplicator").html();
                let html = text.replaceAll("file[0]", "file["+imgCount+"]");
                $("#duplicated").append(html)
            }else{
                $("#more-image-button").hide()
            }
            imgCount++
        }
    </script>
@endsection
@section('page_script')
    @include('admin.script_image_edit')
    @include('admin.script_image_edit_multiple')
@endsection
