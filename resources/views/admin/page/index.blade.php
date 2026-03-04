@extends('layouts.app')
@section('content')

<style>
    td img{
        height: 132px;
    }
</style>
<div class="col-lg-12">  
    <div class="mb-3">  
    @include('admin/card_head',[
        'title'=>'Manage Pages',
        'info'=>'',
        'links'=>[
            0=>['text'=>'Add a page','link'=>'page/create']
        ]  
    ])    
        <div class="">
            <table class="mb-0 table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page Name</th>
                        <th>Image</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contents as $content)
                    <tr>
                        <th scope="row">{{ $content->id }}</th>
                        <td>{{ $content->name }}</td>
                        <td style="background:#ddd">
                            @foreach ($content->upload as $item)
                                @if(!empty($item['url']))
                                <img src="{{ asset( 'images/uploads/thumb/'.$item['url']) }}" alt="{{ $item['name'] ?? '' }}" >  
                                @else
                                <img src="{{ asset( 'images/uploads/thumb/'.$item['file']) }}" alt="{{ $item['name'] ?? '' }}" >  
                                @endif
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
                                <a href="{{URL::to('admin/page/'.$content->id.'/edit')}}" title="Edit" style="float: left; margin-left: 10px; margin-right: 10px">
                    
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                    Edit
                                    </button>
                    
                                </a>   
                                <form action="{{URL::to('admin/page/'.$content->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>Delete</button>
                                </form>
                            </td>
                    </tr>
                    @empty
                        No Page Found
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection