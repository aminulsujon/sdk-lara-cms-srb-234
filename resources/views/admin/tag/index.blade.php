@extends('layouts.app')
@section('content')
@php
$arr_tag_type = [1=>'Top Menu',2=>'Footer Menu',3=>'Category',4=>'Tags',5=>'Special',6=>'Reporters',7=>'Events',8=>'Areas'];
@endphp
<div class="main-card mb-3 card">
  @include('admin/card_head',[
    'title'=>'Website '.$arr_tag_type[$tagtype],
    'info'=>'Add, Edit, Update, Delete from here..',
    'links'=>[
        0=>['text'=>'Create New','link'=>'/admin/tag/create?type='.$tagtype],
        1=>['text'=>'Top Menu','link'=>'/admin/tag/1'],
        2=>['text'=>'Footer Menu','link'=>'/admin/tag/2'],
        3=>['text'=>'Category','link'=>'/admin/tag/3'],
        4=>['text'=>'Tags','link'=>'/admin/tag/4'],
        5=>['text'=>'Special','link'=>'/admin/tag/5',
        6=>['text'=>'Reporters','link'=>'/admin/tag/6'],
        7=>['text'=>'Events','link'=>'/admin/tag/7'],
        8=>['text'=>'Areas','link'=>'/admin/tag/8']]
      ]  
  ])
      <style>
        .status-1{background: #28a745;}
        .status-2{background: #ffc107;}
        .status-3{background: #17a2b8;}
        .status-4{background: #dc3545;}
        .badge{padding: 5px 10px; color: #fff;}
      </style>
  <div class="card-body">
  <?php
  
    $arr_status = [1=>'Active',2=>'Inactive',3=>'Pending',4=>'Disabled'];
    $menus = [];
    $i = 1;
    foreach($tags as $tag){
      //dump($tag);
      if(empty($tag->parent)){
        $menus[$tag->id]['id']= $tag->id;
        $menus[$tag->id]['title']= $tag->title;
        $menus[$tag->id]['linkto']= $tag->linkto;
        $menus[$tag->id]['linkUrl']= $tag->linkUrl;
        $menus[$tag->id]['status']= $tag->status;
        $menus[$tag->id]['sequence']= $tag->sequence;
        $menus[$tag->id]['sequencelead']= $tag->sequencelead;
      }else{
        
        $child[$tag->parent][$i]['id'] = $tag->id;
        $child[$tag->parent][$i]['parent'] = $tag->parent;
        $child[$tag->parent][$i]['title'] = $tag->title;
        $child[$tag->parent][$i]['linkto'] = $tag->linkto;
        $child[$tag->parent][$i]['linkUrl'] = $tag->linkUrl;
        $child[$tag->parent][$i]['status'] = $tag->status;
        $child[$tag->parent][$i]['sequence'] = $tag->sequence;
        $child[$tag->parent][$i]['sequencelead'] = $tag->sequencelead;

        // $child[$tag->parent][$i]['children'] = $tag->parent;

        $i++;
      }
    }
    // dd($menus,$child);
    ?>
    <div class="row">
      <div class="col-md-12">
        @foreach ($menus as $key => $value)
          <div class="main-menu mb-2">
            <div class="menu-title">
              {{ $value['title'] }} - {{ $value['sequence'] }} / {{ $value['sequencelead'] }}
              
            </div>
            <div class="menu-edit float-right">
              <span class="badge badge-info status-{{ $value['status'] ?? '' }}"> {{ $arr_status[$value['status']] ?? '' }}</span> &nbsp; &nbsp;
              <a href="{{ URL::to('admin/tag/'.$value['id'].'/edit') }}">Edit</a>
            </div>   
          </div>
          @if(!empty($child[$key]))
              @foreach ($child[$key] as $ke => $val)
                <div class="sub-menu mb-2 ml-4">
                  <div class="menu-title">
                    {{ $val['title'] }} - {{ $val['sequence'] }} / {{ $val['sequencelead'] }}
                  </div>
                  <div class="menu-edit">
                    <span class="badge badge-info status-{{ $val['status'] ?? '' }}"> {{ $arr_status[$val['status']] ?? '' }}</span>
                    <a href="{{ URL::to('admin/tag/'.$val['id'].'/edit') }}">Edit</a>
                  </div>   
                </div>
                @if(!empty($child[$val['id']]))
                  @foreach ($child[$val['id']] as $gke => $gval)
                  <div class="sub-menu sub-menuc ml-8 mb-2">
                    <div class="menu-title">
                      {{ $gval['title'] }} - {{ $gval['sequence'] }} / {{ $gval['sequencelead'] }}
                    </div>
                    <div class="menu-edit">
                      <span class="badge badge-info status-{{ $gval['status'] ?? '' }}"> {{ $arr_status[$gval['status']] ?? '' }}</span>
                      <a href="{{ URL::to('admin/tag/'.$gval['id'].'/edit') }}">Edit</a>
                    </div>   
                  </div>
                  @endforeach 
                @endif   
              @endforeach          
          @endif
        @endforeach
      </div>
    </div>
  </div>
</div>
<style>
  .tag-table ul li{list-style-type: none;}
  .main-menu{
    background: #efefef;
    font-weight: 600;
    display: flex;
    justify-content: space-between;
    padding: 10px;
    border: 1px solid #e5e5e5;
    border-radius: 2px;

  }
  .sub-menu{
    background: #efefef;
    display: flex;
    justify-content: space-between;
    border: 1px solid #e5e5e5;
    border-radius: 2px;
  }
  .sub-menuc{
    background: #fdfdfd;
  }
</style>
@endsection