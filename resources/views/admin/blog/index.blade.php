@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    
    <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'Blog Management',
            'info'=>'Manage and Create your blogs from this page, image size should be 900x600px',
            'links'=>[
                0=>['text'=>'Create Blog','link'=>'/admin/blog/create'],
                ]  
            ])
    <div class="card-body">
    <table class="mb-0 table table-bordered">
        <thead>
            <tr>
                
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
    <tbody>
        @php $i=1 @endphp
    @forelse ($contents as $content)
    <tr>
        
        <td>
            <h6 class="mb-2">
            {{ $content->name }} </h6>
            
        </td>
        <td style="width: 200px">
            @foreach ($content->upload as $item)
                @include('admin.image_display_dynamic',['item'=>$item,'folder_path'=>'large','height'=>50])
            @endforeach
        </td>
        <td>
        @php
            if($content->status == 1){
                    echo  "<div class='btn btn-success badge-shadow'>Active</div>";
                }else{
                    echo  "<div class='btn btn-danger badge-shadow'>Inactive</div>";
                }
        @endphp
        </td>
        <td style="width:150px">
            <a href="{{URL::to('admin/blog/'.$content->id.'/edit')}}" title="Edit" style="float: left; margin-left: 10px; margin-right: 10px">

                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
Edit
                </button>

            </a>   
            <form action="{{URL::to('admin/blog/'.$content->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>Delete</button>
            </form>
        </td>
        </tr>
    @empty
        No Blog Found
    @endforelse
    </tbody>
    </table>
    </div>
    </div>
    </div>

@endsection