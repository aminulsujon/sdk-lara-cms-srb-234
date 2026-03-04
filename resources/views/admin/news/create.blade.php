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
                'title'=>'Create News',
                'info'=>'Create your '.$contenttype.' from this page, image size should be 900x600px',
                'links'=>[
                    0=>['text'=>$contenttype.'News Management','link'=>'/admin/news'],

                    ]  
                ])

                <style>
                .reporters label {
                    display: inline-block;
                    position: relative;
                    padding-left: 26px;
                    max-height: 20px;
                    overflow: hidden;
                }
                .reporters label input {
                position: absolute;
                top: 4px;
                left: 0px;
                }
                    </style>
            <div class="card-body">
                <form id="myForm" action="{{URL::to('admin/news')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    {{-- @include('admin.form_contenttype') --}}
                    
                    
                    <input type="hidden" value="news" name="contenttype">
                    @include('admin.form_name') 
                    @include('admin.form_slug')
                    @include('admin.form_subtitle')
                    @include('admin.form_summary')  
                    @include('admin.form_editor')
                    
                    @include('admin.form_image_upload_multiple1')
                    @include('admin.form_youtubevideo')
                    <h6>Publish in Events</h6>
                    @include('admin.form_category',['categories'=>$tags_events])
                    
                    <h6>Show in Home</h6>
                    @include('admin.form_category',['categories'=>$tags_special]) <br/>
                    @include('admin.form_seq')<br/>
                    <h6>Category</h6>
                    @include('admin.form_category',['categories'=>$tags_category])
                    
                    <h6>Reporters</h6>
                    <div class="reporters grid grid-cols-4">
                        @include('admin.form_category',['categories'=>$tags_reporter])
                    </div> 

                    <h6>News Area</h6>
                    <div class="reporters grid grid-cols-4">
                        @include('admin.form_area',['categories'=>$tags_areas])
                    </div> 

                    {{-- @include('admin.form_tags') --}}

                    
                    @include('admin.form_meta')
                    @include('admin.form_status')
                    @include('admin.button_submit')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
