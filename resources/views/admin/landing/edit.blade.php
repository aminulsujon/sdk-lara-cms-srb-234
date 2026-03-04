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
        <div class="mb-3">
            @include('admin/card_head',[
                'title'=>'Edit the Landing Page',
                'info'=>'',
                'links'=>[
                    0=>['text'=>'Landing page list','link'=>'/admin/landing'],1=>['text'=>'Create new','link'=>'/admin/landing/create']
                ]  
            ])
            @php
                    // dd($landing);
            @endphp
            <div class="">
                <form class="" action="{{URL::to('admin/landing')}}" method="post">
                    @csrf
                    <div class="mb-2 grid grid-cols-6 gap-2">
                        <label for="linktype" class="">Link type</label>
                        <input name="linktype" value="{{ $landing['linktype'] ?? '' }}" type="text" class="disabled:bg-gray-200" required="required" disabled="disabled">
                    </div>
                    @include('admin/form_slug',['slug'=> $landing['pagelink'],'isdisabled' => 'disabled'])
                    <div class="mb-2 grid grid-cols-6 gap-2">
                        <label for="nextpagelink" class="">Next page link</label>
                        <input name="nextpagelink" value="{{ $landing['nextpagelink'] ?? ''}}" type="text" class="form-control" >
                    </div>
                    <div class="mb-2 grid grid-cols-6 gap-2">
                        <label for="statuscode" class="">Status code</label>
                        <input name="statuscode" value="{{ $landing['statuscode'] ?? '' }}" type="text" class="form-control" required="required">
                    </div>
                    @include('admin/button_submit')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection