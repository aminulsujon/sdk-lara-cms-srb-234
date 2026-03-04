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