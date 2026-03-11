@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    
    <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'User management',
            'info'=>'Manage User from this page, image size should be 900x600px',
            'links'=>[
                0=>['text'=>'List users','link'=>'/admin/user'],
                ]  
            ])
        <div class="card-body">
        
<form method="POST" action="{{ route('user.update',$user->id) }}">
@csrf
@method('PUT')

<input type="text" name="name" value="{{ $user->name }}">

<input type="email" name="email" value="{{ $user->email }}">

<input type="text" name="role" value="{{ $user->role }}">

<button type="submit">Update</button>

</form>
        </div>
    </div>
</div>

@endsection