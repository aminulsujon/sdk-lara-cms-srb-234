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
                'title'=>'Create page',
                'info'=>'Create your pages from this page, image size should be 900x600px',
                'links'=>[
                    0=>['text'=>'Page Management','link'=>'/admin/page'],

                    ]  
                ])
            <div class="card-body">
                <form id="myForm" name="myForm" class="" action="{{URL::to('admin/page')}}"  method="post" enctype="multipart/form-data">
                    @csrf
                    @include('admin.form_name') 
                    @include('admin.form_slug')
                    {{-- @include('admin.form_category',['categories'=>$tags_category]) --}}
                    @include('admin.form_editor')
                    
                    {{-- @include('admin.form_tags') --}}
                    {{-- @include('admin.form_image_upload_single') --}}
                    @include('admin.form_meta')
                    @include('admin.form_status')
                    @include('admin.button_submit')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page_script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('admin.script_image_edit')
    @include('admin.script_image_edit_multiple')
@endsection