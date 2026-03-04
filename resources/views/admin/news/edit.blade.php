@extends('layouts.app')
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'Edit '.$content->content_type,
            'info'=>'Edit your '.$content->content_type.' from this page, image size should be 900x600px',
            'links'=>[
                0=>['text'=>$content->content_type.' Management','link'=>'/admin/news'],
                1=>['text'=>'Create New '.$content->content_type,'link'=>'/admin/news/create'],
                ]  
            ])
    <div class="card-body">
    <form id="myForm" action="{{URL::to('admin/news/'.$content->id)}}"  method="post" enctype="multipart/form-data">    
    @csrf
    @method('PATCH')
    
    @if(!empty($content->upload[0]['url']))
        <img class="mb-3" src="{{ $content->upload[0]['url'] }}" alt="" height="50"><br>
    @endif

    @php
    $old_tags = $content->tags->pluck('id')->toArray();
    foreach($old_tags as $otag){
        echo "<input type='hidden' name='old_tags[]' value='".$otag."'>";
    }
    @endphp
    
    
    @include('admin.form_name',['name'=>$content->name])
    @include('admin.form_slug_edit',['slug'=>$content->slug])
    @include('admin.form_subtitle')
    @include('admin.form_summary') 
    @include('admin.form_youtubevideo')
    @include('admin.form_editor',['details'=>$content->details])
    @if(!empty($content->upload[0]))   
        <div id="prevUploads">      
            @foreach($content->upload as $galleryImage)  
                @include('admin.form_image_display_multiple',['file'=>$galleryImage])
            @endforeach
        </div>
        @else               
    @endif      
    {{-- @include('admin.form_image_upload_multiple') --}}
    @include('admin.form_image_upload_multiple1')
    
    <h6>Publish in Events</h6>
    @include('admin.form_category_edit',['categories'=>$tags_events])
    <h6>Category</h6>
    @include('admin.form_category_edit',['categories'=>$tags_category])
    <h6>Home Section</h6>
    @include('admin.form_category_edit',['categories'=>$tags_special])
    @include('admin.form_seq')

    

    
    <h6>Reporters</h6>
    <div class="reporters grid grid-cols-4">
        @include('admin.form_category_edit',['categories'=>$tags_reporter])
    </div>

    <h6>News Areas</h6>
    <div class="reporters">
        {{-- @include('admin.form_area',['categories'=>$tags_areas]) --}}
        @include('admin.form_area_edit',['categories'=>$tags_areas])
    </div>
    
    {{-- @include('admin.form_tags') --}}
    
    
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    @include('admin.script_image_edit_multiple')
@endsection

@section('page_script')
    
@endsection