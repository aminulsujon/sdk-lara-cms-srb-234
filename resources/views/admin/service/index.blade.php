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
        'title'=>'Manage Services',
        'info'=>'',
        'links'=>[
            0=>['text'=>'Add a service page','link'=>'service/create']
        ]  
    ])    
        <div class="">
            <table class="table w-full">
                <thead class="bg-gray-200 text-left">
                    <tr>
                        <th class="p-2">ID</th>
                        <th class="p-2">Page Name</th>
                        <th class="p-2">Image</th>
                        <th class="p-2">status</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contents as $content)
                    <tr class="even:bg-amber-50 odd:bg-blue-50">
                        <td class="p-2" scope="row">{{ $content->id }}</td>
                        <td class="p-2">{{ $content->name }}</td>
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
                            <a href="{{URL::to('admin/service/'.$content->id.'/edit')}}" title="Edit" style="float: left; margin-left: 10px; margin-right: 10px">

                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>Edit</button>

                            </a>   
                            <form action="{{URL::to('admin/service/'.$content->id)}}" method="post">
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