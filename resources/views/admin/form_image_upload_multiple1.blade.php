<div id="image-upload-wrapper">

    <div class="border p-2 mb-2 bg-light image-block">
        <legend>Upload Image</legend>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative form-group d-none">
                    <input placeholder="Image Name" name="gfx[0][name]" type="text" class="form-control">
                </div>

                <div class="position-relative form-group">
                    <input name="gfx[0][caption]" placeholder="Image Caption" type="text" class="form-control">
                </div>

                <div class="position-relative form-group d-none">
                    <textarea name="gfx[0][description]" class="form-control">Description...</textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="position-relative form-group">
                    <input name="gfx[0][url]" type="text" class="form-control mb-3 d-none" placeholder="Image external URL">
                    <input name="gfx[0][item]" type="file" class="form-control pb-2">
                    <div class="mt-4 border p-2 d-none">
                        Image Preview
                    </div>
                </div>
            </div>
        </div>

        <!-- Remove button -->
        <button type="button" class="btn btn-danger btn-sm remove-image mt-2">
            Remove
        </button>
    </div>

</div>

<!-- Add button -->
<button type="button" id="add-image" class="btn btn-success btn-sm mt-2 mb-8">
    + Add Another Image
</button>

<script>
let imageIndex = 0;

document.getElementById('add-image').addEventListener('click', function () {
    imageIndex++;

    const wrapper = document.getElementById('image-upload-wrapper');

    const block = `
    <div class="border p-2 mb-2 bg-light image-block">
        <legend>Upload Image</legend>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative form-group d-none">
                    <input placeholder="Image Name" name="gfx[${imageIndex}][name]" type="text" class="form-control">
                </div>

                <div class="position-relative form-group">
                    <input name="gfx[${imageIndex}][caption]" placeholder="Image Caption" type="text" class="form-control">
                </div>

                <div class="position-relative form-group d-none">
                    <textarea name="gfx[${imageIndex}][description]" class="form-control">Description...</textarea>
                </div>
            </div>

            <div class="col-md-12">
                <div class="position-relative form-group">
                    <input name="gfx[${imageIndex}][url]" type="text" class="form-control mb-3 d-none" placeholder="Image external URL">
                    <input name="gfx[${imageIndex}][item]" type="file" class="form-control pb-2">
                    <div class="mt-4 border p-2 d-none">
                        Image Preview
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-danger btn-sm remove-image mt-2">
            Remove
        </button>
    </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', block);
});

// Remove image block
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-image')) {
        e.target.closest('.image-block').remove();
    }
});
</script>
