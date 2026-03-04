@extends('layouts.app')
@section('content')
@php
$arr_tag_type = [1=>'Top Menu',2=>'Footer Menu',3=>'Category',4=>'Tags',5=>'Special',6=>'Reporters',7=>'Events',8=>'Areas'];
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'Website '.$arr_tag_type[$tagtype],
            'info'=>'Add, Edit, Update, Delete from here..',
            'links'=>[
                0=>['text'=>'Create New','link'=>'/admin/tag/create?type='.$tagtype,'class'=>'btn btn-success'],
                1=>['text'=>'Top Menu','link'=>'/admin/tag/1'],
                2=>['text'=>'Footer Menu','link'=>'/admin/tag/2'],
                3=>['text'=>'Category','link'=>'/admin/tag/3'],
                4=>['text'=>'Tags','link'=>'/admin/tag/4'],
                5=>['text'=>'Special','link'=>'/admin/tag/5'],
                6=>['text'=>'Reporters','link'=>'/admin/tag/6'],
                7=>['text'=>'Events','link'=>'/admin/tag/7'],
                8=>['text'=>'Areas','link'=>'/admin/tag/8']
            ]  
        ])
            <div class="card-body">
                <form class="" action="{{URL::to('admin/tag/')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{$tagtype}}"/>
                    <div class="position-relative form-group">
                        <label class="">Parent Menu</label>
                        @php
                        if(!empty($tags)){
                            echo '<select name="parent" class="form-select fs-4">';
                                echo '<option value=0>Select</option>';
                            foreach($tags as $key => $value){
                                echo '<option value="'.$value['id'].'">'.$value['title'].'</option>';
                            }
                            echo '</select>';
                        }
                        @endphp
                    </div>
                    <div class="position-relative form-group">
                        <label class="">Menu Name</label>
                        <input id="title" name="title" type="text" required="required" class="form-control">
                    </div>
                    @include('admin.form_slug')
                    <div class="position-relative form-group">
                        <input name="tag_type" type="hidden" required="required" value={{$tagtype}}>
                    </div>
                    <div class="position-relative form-group">
                        <label class="">Web Link</label>
                        <input name="linkto" type="text" class="form-control">
                    </div>
                    <div class="position-relative form-group">
                        <label class="">Outer Link</label>
                        <input name="linkUrl" type="text" class="form-control">
                    </div>
                    
                    <div class="position-relative form-group">
                        <label class="">Sequence</label>
                        <input name="sequence" type="number" class="form-control">
                    </div>

                    <div class="position-relative form-group">
                        <label>Background Color</label>
                        <input name="background" type="color" class="form-control">
                    </div>

                    <div class="position-relative form-group">
                        <label>Text Color</label>
                        <input name="color" type="color" class="form-control">
                    </div>


                    @include('admin.form_status')
                    @include('admin.button_submit')
                </form>
            </div>
        </div>
    </div>
</div>
@endsection