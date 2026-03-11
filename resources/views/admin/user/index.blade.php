@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    
    <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'User management',
            'info'=>'Manage User from this page, image size should be 900x600px',
            'links'=>[
                0=>['text'=>'Create new','link'=>'/admin/user/create'],
                ]  
            ])
        <div class="card-body">
        


            <a href="{{ route('user.create') }}">Add User</a>

            <table class="table">
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
            </tr>

            @foreach($users as $user)
            <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
            <a href="{{ route('user.edit',$user->id) }}">Edit</a>

            <form action="{{ route('user.destroy',$user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
            </form>

            </td>
            </tr>
            @endforeach

            </table>
        </div>
    </div>
</div>

@endsection