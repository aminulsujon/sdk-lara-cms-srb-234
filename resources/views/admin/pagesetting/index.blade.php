@extends('layouts.app')
@section('content')
<div class="main-card mb-3 card">
  @include('admin/card_head',[
    'title'=>'Pages Social and SEO Setting',
    'info'=>'Editing this section will change socail share data and SEO information.',
    'links'=>[
        0=>['text'=>'New page setting','link'=>'pagesetting/create']
      ]  
  ])
  <div class="card-body">
    <div class="bootstrap-table bootstrap4">
      <div class="fixed-table-toolbar"></div>
      <div class="fixed-table-container" style="padding-bottom: 0px;">
        <div class="fixed-table-header" style="display: none;">
          <table></table>
        </div>
        <div class="fixed-table-body">
          <table data-toggle="table" data-sort-name="stargazers_count" data-sort-order="desc" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>Share Image</th>
                <th>Share Info</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            
              @foreach($pagesettings as $content)
              <tr>
                <td>
                  <img width="200" src="../images/uploads/large/{{ $content->meta_image }}">
                </td>
                <td>
                   <u>{{ $content->meta_slug }} </u>
                   <h1>{{ $content->meta_heading }} </h1>
                   <b>{{ $content->meta_title }}</b><br>
                   @php
                    $string = explode(',',$content->meta_keyword);
                    foreach($string as $key => $value){
                      echo '<span class="badge bg-secondary mr-2 text-white">'.$value.'</span>';
                    }
                   @endphp
                   <p>{{ $content->meta_description }}</p>
                </td>
                <td>
                <a href="{{URL::to('admin/pagesetting/'.$content->id.'/edit')}}" title="Edit">
                  edit
                </a>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
        <div class="fixed-table-footer">
          <table>
            <thead>
              <tr></tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="fixed-table-pagination" style="display: none;"></div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>

@endsection