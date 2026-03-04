@extends('admin.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="main-card mb-3 card">
            @include('admin/card_head',[
                'title'=>'View blog',
                'info'=>'Blog details goes here...',
                'links'=>[
                    0=>['text'=>'Blog Management','link'=>'/admin/blog'],
                    1=>['text'=>'Create New Blog','link'=>'/admin/blog/create'],
                    ]  
                ])
        <div class="card-body">
        <form id="blog-show" action="{{URL::to('admin/blog/'.$content->id)}}"  method="post" enctype="multipart/form-data">
            
        @csrf
        @method('PATCH')
        <div class="position-relative form-group">
            <label for="exampleEmail" class="">Name</label>
            <input name="name" required="required" type="text" class="form-control" value="{{ $content->name }}">
        </div>

        @include('admin.form_slug_edit',['slug'=>$content->slug])
        @php
        $arr_selected = [];
        foreach($content->tag as $tag){
            array_push($arr_selected,$tag->id);
        }
        @endphp

        <div id="tagRemoveRequest"></div>
        @foreach($tags_category as $tag)
            @if($tag->tag_type == 3)
                @if(in_array($tag->id,$arr_selected))
                    <div title="Set tag {{$tag->title}}" class="d-inline-block mb-2 mr-2">
                        <label class="catcontainer">{{$tag->title}}
                            <input onclick="setRemoveTags({{$tag['id']}});" name="tag[]" checked="checked" value='{{$tag->id}}' type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                @else
                    <div title="Set tag {{$tag->title}}" class="d-inline-block mb-2 mr-2">
                        <label class="catcontainer">{{$tag->title}}
                            <input name="tag[]" value='{{$tag->id}}' type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                @endif      
            @endif
        @endforeach   
        @if(!empty($content->upload[0]['url']))
            <img class="mb-3" src="{{ $content->upload[0]['url'] }}" alt="" height="50"><br>
        @endif
        
        <div class="position-relative form-group">
            @include('admin.form_ckeditor',['label'=>'News Description','name'=>'description','value'=>  $content->description])
        </div>
        <div class="mb-2">
            <input type="hidden" name="image_remove_id" id="image_remove_id" value="104">
            Selected Tags: 
            <div id="prevTags">
                @if(!empty($content->tag[0]))
                    @foreach($content->tag as $tag)
                        @if($tag->tag_type == 4)
                        <div id="oldTag{{$tag['id']}}" class="badge badge-info mr-2 mb-2">
                            {{$tag->title}} 
                            <a onclick="setRemoveTags({{$tag['id']}});" href="javascript:void(0);"> x </a>
                        </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        @include('admin.form_tags')

        @if(!empty($content['upload'][0]))
            @include('admin.form_image_display_single',['file'=>$content['upload'][0]])
            <div style="display:none" id="image_upload_single">@include('admin.form_image_upload_single')</div>
        @else
            <div class="border mb-2 p-2">@include('admin.icon_image') No image uploaded yet</div>
            <div id="image_upload_single">@include('admin.form_image_upload_single')</div>
        @endif
        
        @include('admin.form_meta',[
            'heading'=>$content->meta_heading,
            'keyword'=>$content->meta_keywords,
            'meta_title'=>$content->meta_title,
            'meta_description'=>$content->meta_description,
            'meta_robots'=>$content->meta_robots,
            'meta_canonical'=>$content->meta_canonical,
            'meta_image'=>$content->meta_image
        ])
        @include('admin/form_status',['value'=>$content->status])
        </div>
    
        </form>
        </div>
        
    </div><!-- end of col-md-6 -->
    <div class="col-md-6">
        <div class="main-card mb-3 card">
            <div class="card-body">
            <h4 class="border-bottom pb-2">@if(!empty($content->comment[0])) {{ count($content->comment) }} @else 0 @endif Comments</h4>
            <table width="100%" class="table table-bordered">
                <tr>
                    <th>Comments</th>
                </tr>
                @if(!empty($content->comment[0])) 
                    @foreach($content->comment as $comment)
                    <tr>
                        <td>
                            <div id="comment-{{ $comment->id }}" class="d-inline-block font-weight-bold status-{{ $comment->status }}">
                            {{ $comment->name ?? '' }} at <span> {{ date('M d, Y - h:i') }} </span>
                            </div>
                            <div>
                                {{$comment->description}}
                            </div>
                            <div class="action mt-2">
                                <a onclick="changeStatus('Comment',{{ $comment->id }},{{ $comment->status }},1);" class="btn btn-success" href="javascript:void(0);">Publish</a>
                                <a onclick="changeStatus('Comment',{{ $comment->id }},{{ $comment->status }},2);" class="btn btn-danger" href="javascript:void(0);">Unpublish</a>
                                <a onclick="changeStatus('Comment',{{ $comment->id }},{{ $comment->status }},4);" class="btn btn-secondary" href="javascript:void(0);">Remove</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </table>
            </div>
        </div>
    </div><!-- end of col-md-6 -->
</div><!-- end row -->
</div>

<style>
    .close{
        line-height: 0.3;
        font-weight: normal;
        color: black;
        opacity: 1;
        margin-left: 10px;
    }
    .disabled{color:#ddd}
    .disabled.badge-info{background:#eee}
</style>

<script>
var form = document.getElementById("blog-show");
var elements = form.elements;
for (var i = 0, len = elements.length; i < len; ++i) {
    elements[i].readOnly = true;
}

function changeStatus(table,id,status,newstatus){
    console.log('changeStatus',table,id,newstatus)
    devpath = window.location.origin
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: "POST", 
        url: devpath+ "/admin/changestatus/"+table+'/'+id+'/'+newstatus,
        success: function(data) { 
            if(data){
                console.log('true',data)
                $("#comment-"+id).removeClass("status-"+status)
                $("#comment-"+id).addClass("status-"+newstatus)
            }else{
                // console.log('false',data)
            }
        }
    })
}
</script>
@endsection
@section('page_script')
    @include('admin.script_image_edit')
    @include('admin.script_tag_edit')
@endsection