@php
// dd($content->tags);   
@endphp
<div class="position-relative form-group border p-2">
    <label for="tags" class="">Select Topics</label>
    <input type="text" name="tagSearch" id="tagSearch" placeholder="Search tag..">
    <a href="{{URL::to('admin/tag/create?type=4')}}" target="_blank">Create new topics</a>
    <div class="mb-2">
        
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
    
    <div id="tagAppendshow" class="mt-4">
    @if(!empty($content->tags))
        @php
        foreach($content->tags as $otag){
          if(!empty($otag->tagtype) && $otag->tagtype == 4){
            echo "<input type='checkbox' checked='checked' name='old_tags[]' value='".$otag."' id='hidden-tag-old".$otag->id."'><span id='hidden-tag-show".$otag->id."'>".$otag->title."</span>";
          }
        }
        @endphp
       @endif
    </div>
    <div id="tagAppend" class="mt-4">
    
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function setRemoveTags(id){
        if($("#tagRemoveRequest input[value='"+id+"']").length){
            $("#tagRemoveRequest input[value='"+id+"']").remove()
        }else{
            $("#tagRemoveRequest").append('<input value='+id+' type="hidden" name="removeTag[]">')
        }
        
        
        $("#oldTag"+id).toggleClass('disabled')
    }
    function setTag(id,title){
        var tag = '<div id="newTag'+id+'" class="badge badge-info mr-2 mb-2">'+title+' <a onclick="setRemoveNewTags('+id+');" href="javascript:void(0);"> x </a></div>';
        $("#prevTags").append(tag)
    }
    function setRemoveNewTags(id){
        $("#newTag"+id).remove()
    }
</script>
<script>
  console.log('search...')
    $("#tagSearch").keyup(function(){
        console.log('search...')
        devpath = window.location.origin
        var nameValue = $("#tagSearch").val()
        if(nameValue){
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: "POST", 
                url: devpath+ "/admin/searchTag/"+nameValue,
                success: function(data) { 
                    // console.log(data)
                    $("#tagAppend").empty()
                    if(data){
                        for (var i=0; i<data.length; i++) {
                            var tag = '<div title="Set tag '+data[i].title+'" class="d-inline-block mb-2 mr-2">'+
                                '<label class="ccontainer">'+data[i].title+
                                    '<input onclick="setTag(`'+data[i].id+'`,`'+data[i].title+'`);" name="tag[]" value='+data[i].id+' type="checkbox">'+
                                    '<span class="checkmark"></span>'+
                                '</label>'+
                            '</div>'
                            $("#tagAppend").append(tag)
                        }
                    }else{
                    //   console.log('Page link not found, or permanently removed')
                    }
                }
                })
        }else{
            $("#tagAppend").empty()
        }
    });
</script>
<script>
  function setTag(id, title) {
    // alert('Tag: ' + title + id);
    const checkbox = $('input[value="' + id + '"][name="tag[]"]');
    // alert(checkbox)
    if (checkbox.prop('checked')) {
      // Checkbox is checked — create hidden input if needed
      if ($('#hidden-tag-' + id).length === 0) {
        $('#tagAppendshow').append(
          '<input type="checkbox" checked="checked" name="tags[]" value="' + id + '" ><span id="hidden-tag-show' + id + '">'+ title + '</span>'
        );
      }
    } else {
      // Checkbox is unchecked — remove the hidden input
      // $('#hidden-tag-' + id).remove();
      // $('#hidden-tag-show' + id).remove();
    }
  }
</script>

<style>

    /* The container */
.ccontainer,.catcontainer {
  display: block;
  position: relative;
  padding-left: 10px;
  padding-right: 10px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  margin-bottom:0;
  border:1px solid #ddd
}

/* Hide the browser's default checkbox */
.ccontainer input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.ccontainer .checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  background-color: #eee;
  visibility: hidden;
}

/* On mouse-over, add a grey background color */
.ccontainer:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.ccontainer input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.ccontainer .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.ccontainer input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.ccontainer .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
</style>