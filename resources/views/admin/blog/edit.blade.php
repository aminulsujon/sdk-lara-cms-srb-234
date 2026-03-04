@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'Edit blog',
            'info'=>'Edit your blogs from this page, image size should be 900x600px',
            'links'=>[
                0=>['text'=>'Blog Management','link'=>'/admin/blog'],
                1=>['text'=>'Create New Blog','link'=>'/admin/blog/create'],
                ]  
            ])
    <div class="card-body">
    <form id="myForm" action="{{URL::to('admin/blog/'.$content->id)}}"  method="post" enctype="multipart/form-data">    
    @csrf
    @method('PATCH')
    <div class="position-relative form-group">
        <label for="exampleEmail" class="">Name</label>
        <input name="name" required="required" type="text" class="form-control" value="{{ $content->name }}">
    </div>
    @include('admin.form_slug_edit',['slug'=>$content->slug])
    
    @if(!empty($content->upload[0]['url']))
        <img class="mb-3" src="{{ $content->upload[0]['url'] }}" alt="" height="50"><br>
    @endif
    
    
    @include('admin.form_editor',['details'=>$content->details])

    <div class="mb-2">
        
        Selected Tags: 
        <div id="prevTags">
            @if(!empty($content->tag[0]))
                @foreach($content->tag as $tag)
                    @if($tag->tag_type == 4)
                    <div id="oldTag{{$tag['id']}}" class="badge badge-info mr-2 mb-2">
                        {{$tag->title}} 
                        <a onclick="setRemoveTags({{$tag['id']}});" href="javascript:void(0);"> x </a>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    @include('admin.form_tags')
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