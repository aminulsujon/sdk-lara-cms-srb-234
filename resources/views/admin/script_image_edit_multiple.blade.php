<script>
    function setImageRemoval(imageid){
        $("#image_remove_id"+imageid).val(imageid)
        $("#image_remove_button"+imageid).hide()
        $("#image_remove_warning"+imageid).show()
        // $("#image_upload_single").show()
    }
    function cancelImageRemoval(imageid){
        $("#image_remove_id"+imageid).val('')
        // $("#image_remove_id").val('')
        $("#image_remove_button"+imageid).show()
        $("#image_remove_warning"+imageid).hide()
        // $("#image_upload_single").hide()
    }
</script>