@extends('layouts.app')
@section('content')
<div class="main-card mb-3 card">
  <div class="card-body">
    <form class="border p-4" action="{{URL::to('admin/siteoption')}}" method="post">
        @csrf
        <div class="flex">
            <div class=""><input name="okey" type="text" class="border rounded p-2" placeholder="Key"></div>
            <div class="mx-2"><input name="ovalue" type="text" class="border rounded p-2" placeholder="Value"></div>
            <div class=""><button class="border rounded mx-2 p-2 bg-gray-4000" type="submit">Save</button></div>
        </div>
        @include('admin.form_image_upload_single')
    </form>
    
    <div class="clearfix"></div>
  </div>
</div>
@endsection