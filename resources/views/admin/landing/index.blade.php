@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    
    <div class="mb-3">
    @include('admin/card_head',[
        'title'=>'Manage Landing',
        'info'=>'',
        'links'=>[
            0=>['text'=>'Add a landing page','link'=>'landing/create']
        ]  
    ])

    
    <div class="p-2">
        <table class="table w-full">
            <thead class="bg-gray-200 text-left">
                <tr>
                    <th class="p-2">Id</th>
                    <th class="p-2">PageType</th>
                    <th class="p-2">PageLink</th>
                    <th class="p-2">Status Code</th>
                    <th class="p-2">Theme</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($landings as $landing)
                <tr class="even:bg-amber-50 odd:bg-blue-50">
                    <td class="p-2 dark:text-white">{{ $landing->id }}</td>
                    <td class="p-2 dark:text-white">{{ $landing->linktype }}</td>
                    <td class="p-2 dark:text-white">
                        @if(!empty($landing->nextpagelink))
                            <span class="text-danger dark:text-white">{{ $landing->pagelink }}</span><br>
                            <span class="text-success dark:text-white">{{ $landing->nextpagelink }}</span>
                        @else
                            <span class="text-dark dark:text-white">{{ $landing->pagelink }}</span>
                        @endif
                    </td>
                    <td class="p-2 dark:text-white">{{ $landing->statuscode }}</td>
                    <td>
                        <a class="dark:text-white border px-2 py-1" href="{{URL::to('admin/landecial/'.$landing->pagelink)}}" title="Page Setup">
                            Theme
                        </a>
                    </td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-info btn-sm" href="{{URL::to($landing->pagelink)}}" title="View Webpage" target="_black">
                           Visit
                        </a>
                        <a class="dark:text-white" href="{{URL::to('admin/landing/'.$landing->id.'/edit')}}" title="Edit">
                            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                        </a>
                        <form action="#" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm dark:text-white" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                No Landing Found
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection