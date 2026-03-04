<!-- Editor start -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
@php
if(!empty($details)){
    $cleaned = preg_replace('/<\s*type="text"[^>]*>/i', '', $details);
}else{
    $cleaned = '';
}
@endphp
<label>Details</label>
<div id="editor" style="height:350px" type="text" class="border form-control">{!! $cleaned ?? '' !!}</div>
<input type="hidden" name="details" id="details" >

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<br>

<!-- Initialize Quill editor -->
<script>
    const toolbarOptions = [
['bold', 'italic', 'underline', 'strike'],        // toggled buttons
['blockquote', 'code-block'],
['link', 'image', 'video', 'formula'],

[{ 'header': 1 }, { 'header': 2 }],               // custom button values
[{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
[{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
[{ 'direction': 'rtl' }],                         // text direction

[{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
[{ 'header': [1, 2, 3, 4, 5, 6, false] }],

[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
[{ 'font': [] }],
[{ 'align': [] }],

['clean']                                         // remove formatting button
];
const quill = new Quill('#editor', {
modules: {
    toolbar: toolbarOptions
},
theme: 'snow'
});
</script>
<script>
document.getElementById('myForm').addEventListener('submit', function (e) {
    const divContent = document.getElementById('editor').innerHTML; // or innerHTML
    document.getElementById('details').value = divContent;
});
</script>
<!-- Editor end -->