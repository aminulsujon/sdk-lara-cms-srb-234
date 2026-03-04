@extends('layouts.app')
@section('content')
<?php
function enToBnDate($datetime){
    $en = ['0','1','2','3','4','5','6','7','8','9','AM','PM','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯','এএম','পিএম','জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'];
    return str_replace($en, $bn, $datetime);
}
?>
<style>
    .bg_1,.bg_2, .bg_3,.bg_4,.bg_5,.bg_6,.bg_7,.bg_8,.bg_9,.bg_10,.bg_11,.bg_12{
        font-size: 14px;
        font-weight: 600;
    }
    .bg_1{ background-color: #2eff1b;}
    .bg_2{ background-color: #581bff;}
    .bg_3{ background-color: #1E90FF;}
    .bg_4{ background-color: #FF1493;}
    .bg_5{ background-color: #FF8C00;}
    .bg_6{ background-color: #00CED1;}
    .bg_7{ background-color: #FF4500;}
    .bg_8{ background-color: #32CD32;}
    .bg_9{ background-color: #FF69B4;}
</style>
<div class="col-lg-12">
    
    <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'News management',
            'info'=>'Manage news from this page, image size should be 900x600px',
            'links'=>[
                0=>['text'=>'Create new','link'=>'/admin/news/create'],
                ]  
            ])
        <div class="card-body">
        
        {{-- Search Form --}}
        <form method="GET" action="{{ route('news.index') }}" class="flex flex-wrap items-end gap-4 mb-4 border p-2 rounded bg-light">

                <a href="{{ route('news.index') }}" class="btn btn-secondary">Reset</a>
            {{-- Search Box --}}
            <div>
                <label class="form-label text-sm block">Search</label>
                <input type="text"
                    name="search"
                    class="form-control"
                    placeholder="Search content..."
                    value="{{ request('search') }}"
                    style="width: 220px;">
            </div>

            {{-- Status Filter --}}
            <div>
                <label class="form-label text-sm block">Status</label>
                <select name="status" class="form-control" style="width: 180px;">
                    <option value="">All Status</option>
                    <option value=1 {{ request('status') == 'active' ? 'selected' : '' }}>active</option>
                    <option value=2 {{ request('status') == 'inactive' ? 'selected' : '' }}>inactive</option>
                    <option value=3 {{ request('status') == 'pending' ? 'selected' : '' }}>pending</option>
                    <option value=4 {{ request('status') == 'deleted' ? 'selected' : '' }}>deleted</option>
                </select>
            </div>

            {{-- Date From --}}
            <div>
                <label class="form-label text-sm block">From</label>
                <input type="date"
                    name="from"
                    class="form-control"
                    value="{{ request('from') }}"
                    style="width: 160px;">
            </div>

            {{-- Date To --}}
            <div>
                <label class="form-label text-sm block">To</label>
                <input type="date"
                    name="to"
                    class="form-control"
                    value="{{ request('to') }}"
                    style="width: 160px;">
            </div>

            {{-- Submit + Reset --}}
            <div class="flex gap-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>

        </form>

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
                @php 
                //dd($content); 
                @endphp
                <tr>
                    <td>
                        <h6 class="mb-2">{{ $content->name }}</h6>
                        <div>
                            @foreach($content->tags as $cat)
                                <span class="badge bg_{{ $cat->tag_type }}">{{ $cat->title }}</span>
                            @endforeach 
                        </div>
                        <time datetime="{{ $content->created_at }}">{{ enToBnDate(date('d M Y h:i A', strtotime($content->created_at))) }}</time>
                    </td>
                    <td style="width: 200px">
                        @foreach ($content->upload as $item)
                            @include('admin.image_display_dynamic',['item'=>$item,'folder_path'=>'thumb','height'=>50])
                        @endforeach
                    </td>
                    <td>
                    @php
                        if($content->status == 1){
                            echo  "<div class='btn btn-sm btn-success badge-shadow'>Active</div>";
                        }elseif($content->status == 2){
                            echo  "<div class='btn btn-sm btn-danger badge-shadow'>Inactive</div>";
                        }elseif($content->status == 3){
                            echo  "<div class='btn btn-sm btn-warning badge-shadow'>Pending</div>";
                        }elseif($content->status == 4){
                            echo  "<div class='btn btn-sm btn-info badge-shadow'>Deleted</div>";
                        }
                    @endphp
                    </td>
                    <td style="width:150px">
                        <a href="{{URL::to('admin/news/'.$content->id.'/edit')}}" title="Edit" style="float: left; margin-left: 10px; margin-right: 10px">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                Edit
                            </button>
                        </a>   
                        <form action="{{URL::to('admin/news/'.$content->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            @if($content->status == 4)
                                <button class="btn btn-sm btn-danger mt-2" type="submit" onclick="return confirm('Are you sure to remove permanently?')"><i class="fa fa-trash"></i>Remove permanently</button>
                            @else
                                <button class="btn btn-sm btn-warning" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>Delete</button>
                            @endif
                        </form>
                    </td>
                    </tr>
                @empty
                No Data Found
                @endforelse
            </tbody>
        </table>

        <!--Start pagination -->
        <div class="pagination-area pb-45 text-center mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        {{ $contents->links() }}
                    </div>
                </div>
            </div>
        </div>

    <!-- End pagination  -->
    </div>
    </div>
    </div>

@endsection