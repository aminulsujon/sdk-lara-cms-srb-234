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
        

<form method="POST" action="{{ route('user.store') }}">
@csrf

<input type="text" name="name" placeholder="Name">

<input type="email" name="email" placeholder="Email">

<input type="text" name="role" placeholder="Role">

<input type="password" name="password" placeholder="Password">

<button type="submit">Save</button>

</form>
        </div>
    </div>
</div>

@endsection