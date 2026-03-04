@extends('admin.layouts.app')
@section('content')
<div class="col-lg-12">  
 <div class="main-card mb-3 card">   
        <div class="card-body">
        <h5 class="card-title">Subcribers List</h5>
            <table class="mb-0 table table-bordered">
                <thead>
                <tr>
                    <th style="width:15%;">Serial number</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($subscribes as $subscribe)
                        <tr>
                            <th scope="row">{{ $subscribe->id }}</th>
                            <td>{{ $subscribe->email }} </td>                 
                        </tr>
                    @empty
                        No Subcriber Found
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection