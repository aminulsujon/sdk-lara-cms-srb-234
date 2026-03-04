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
                'title'=>'Create '.$contenttype,
                'info'=>'Create your '.$contenttype.' from this page, image size should be 900x600px',
                'links'=>[
                    0=>['text'=>$contenttype.' Management','link'=>'/admin/content?type='.$contenttype],

                    ]  
                ])
            <div class="card-body">
                <form id="myForm" action="{{URL::to('admin/content')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.form_contenttype')
                    @include('admin.form_name') 
                    @include('admin.form_slug')
                    @include('admin.form_category',['categories'=>$tags_category])
                                         
                    @include('admin.form_editor')
                    @include('admin.form_seq')
                    @include('admin.form_tags')
                    @include('admin.form_image_upload_single')
                    @include('admin.form_meta')
                    @include('admin.form_status')
                    @include('admin.button_submit')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
