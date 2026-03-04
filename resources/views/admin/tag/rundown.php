@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            @include('admin/card_head',[
                'title'=>'Create Tag',
                'info'=>'Website tags.',
                'links'=>[
                    0=>['text'=>'Tag List','link'=>'/admin/tag']
                ]  
            ])
            <div class="card-body">
                <form class="" action="{{URL::to('admin/tag/'.$tag->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <input name="tag_type" value="{{ $tag->tag_type }}" type="hidden" required="required" class="form-control">
                    <div class="position-relative form-group">
                        <label class="">Parent Tag</label>
                        @php
                        if(!empty($tags)){
                            echo '<select name="parent" class="form-select fs-4">';
                                echo '<option value=0>Select</option>';
                            foreach($tags as $key => $value){
                                if(!empty($tag->parent) && $tag->parent == $value['id']){
                                    echo '<option value="'.$value['id'].'" selected="selected">'.$value['title'].'</option>';
                                }else{
                                    echo '<option value="'.$value['id'].'">'.$value['title'].'</option>';
                                }
                                
                            }
                            echo '</select>';
                        }
                        @endphp
                    </div>
                    <div class="position-relative form-group">
                        <label class="">Tag Title</label>
                        <input name="title" value="{{$tag->title}}" type="text" required="required" class="form-control">
                    </div>
                    <!-- @if (Auth::user()->role_id == 1) -->
                    @include('admin.form_slug_edit',['slug'=>$tag->slug])
                    <!-- @endif -->
                    <div class="position-relative form-group">
                        <label class="">Web Link</label>
                        <input name="linkto" value="{{$tag->linkto}}" type="text" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label class="">Outer Link</label>
                        <input name="linkUrl"  value="{{$tag->linkUrl}}" type="text" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label class="">Sequence</label>
                        <input name="sequence"  value="{{$tag->sequence}}" type="text" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label class="">Lead Sequence</label>
                        <input name="sequencelead"  value="{{$tag->sequencelead}}" type="text" class="form-control">
                    </div>
                    
                    @include('admin.form_status',['value'=>$tag->status])
                    @include('admin/button_submit')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection