@extends('layouts.app')
@section('content')
<div class="main-card mb-3 card">
  @include('admin/card_head',[
    'title'=>'Media Server',
    'info'=>'Upload and get link',
    'links'=>[
        0=>['text'=>'Go to dashboard','link'=>'/home']
      ]  
  ])
  <div class="card-body">
    <form class="border p-2 mb-4" action="{{URL::to('admin/upload')}}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
         <div class="col-md-6" >
              <div class="position-relative form-group">
                  <label for="caption" class="">Image Name</label>
                  <input name="name" required="required" type="text" class="form-control">
              </div>
              <div class="position-relative form-group">
                  <label for="caption" class="">Image Caption</label>
                  <input name="caption" required="required" type="text" class="form-control">
              </div>
              @include('admin.form_textarea',['name'=>'description','label'=>'Description','rows'=>4])
          </div>
          <div class="col-md-6">
              @include('admin.form_image',['name'=>'file[]','label'=>'Select Image'])
          </div>
      </div>
      @include('admin.button_submit')
    </form>
    <div class="row border-bottom mb-4">
      <div class="col-sm-6">
        <h4 class="mb-4pb-2">Uploaded Media Files</h4>
      </div>
      <div class="col-sm-6 pb-2">
        <form class="inline" action="{{URL::to('admin/upload/search')}}" method="post">
          @csrf
          <input name="search" type="hidden" value="upload">
          <input name="name" type="text" class="mx-2 border">
          <button class="mt-1 btn btn-success" type="submit">Submit</button>
        </form>
      </div>
    </div>
    <div class="flexible">
      @foreach($uploads as $upload)
        @php
          if(!empty($upload->url)){
            $img_src = $upload->url;
          }else{
            $img_src = $websettings['cms_url'].'/images/uploads/small/'.$upload->file;
          }
        @endphp
          <div class="flexed">
            <div class="py-1">{{$upload->name}}</div>
            <div>
              <img class="img-fluid" src="{{$img_src}}" alt="image-alt" title="image-title">
            </div>
            <div data-address = "{{ $img_src}}" class="py-2">
              <input id="upload-address-{{$upload->id}}" type="text" value="{{ $img_src }}">
              <button class="btn border mt-2" onclick="copyFunction('upload-address-{{$upload->id}}')">Copy file address</button>
            </div>
          </div>
      @endforeach
    </div>
    <div class="paginated">
     {{ $uploads->links() }}
    </div>
  </div>
</div>
<style>
  #imageNotice{display: none;
    background: red;
    color: #fff;
    font-weight: bold;
    padding: 10px;
    margin-bottom: 10px;}
    #imgDisplay{display:none}
  .flexible {
    display: flex;
    flex-wrap: wrap;
    margin: 0 0;
    padding: 0;
    justify-content: flex-start;
  }
  .flexed {
    flex: 0 0 24%;
    max-width: 24%;
    margin: 0 1% 20px 0;
    position: relative;
    border: 1px solid #ddd;
    text-align:center;
  }
  .flexed div:first-child{
    background:#ddd;
    margin-bottom:10px
  }
  .paginated svg{width:20px;height:20px}
  .paginated>nav>div{padding:10px 0}
    @media only screen and (max-width: 600px) {
    .flexed {
      flex: 0 0 46%;
      max-width: 46%;
      margin: 0 1% 20px 0;
      position: relative;
      border: 1px solid #ddd;
      text-align:center;
    }
  }
</style>
@endsection

@section('script_footer')
<script>
  function copyFunction(id) {
    // Get the text field
    var copyText = document.getElementById(id);

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    // Alert the copied text
    alert("Copied the text: " + copyText.value);
  }

  var _URL = window.URL || window.webkitURL;
  $("#imageFile").change(function (e) {
      var file, img;
      if ((file = this.files[0])) {
          img = new Image();
          var objectUrl = _URL.createObjectURL(file);
          img.onload = function () {
              _URL.revokeObjectURL(objectUrl);
          };
          img.src = objectUrl
          img.id= "imgId"
          img.style = "max-height:200px;max-width:100%"
          $("#imgDisplay").html(img).show('slow')
      }
  });
</script>
@endsection