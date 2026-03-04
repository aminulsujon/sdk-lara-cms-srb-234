<script>
function setImageRemoval(imageid){
    console.log(imageid)
    $("#image_remove_id").val(imageid)
    $("#image_remove_button").hide()
    $("#image_remove_warning").show()
    $("#image_upload_single").show()
}
function cancelImageRemoval(){
    $("#image_remove_id").val('')
    $("#image_remove_button").show()
    $("#image_remove_warning").hide()
    $("#image_upload_single").hide()
}
</script>