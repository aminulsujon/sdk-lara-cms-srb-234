@php 
// used in content/create.blade.php, content/edit.blade.php, content/index.blade.php, nav.blade.php
$arr_contenttype = [
    'home'=>'Home',
    'blog'=>'Blog',
    'feature'=>'Features',
    'landing'=>'Landing',
    'page'=>'Page',
    'product'=>'Product',
    'service'=>'Service',
    'slider'=>'Slider',
    'workstep'=>'Work Steps',
    'team'=>'Team',
    'testimonial'=>'Testimonial',
    'work'=>'Our Works'
    ];
@endphp
<div class="mb-3">
<h5>Select Content Type</h5>
    @foreach ($arr_contenttype as $key => $value)
    @if($key == $contenttype)
    <div class="d-inline-block mr-2 mb-2">
      <label class="scontainer">{{$arr_contenttype[$key]}}
          <input checked="checked" value="{{$key}}" type="radio" name="contenttype">
          <span class="checkmark"></span>
      </label>
    </div>
    @else
      <div class="d-inline-block mr-2 mb-2">
        <label class="scontainer">{{$arr_contenttype[$key]}}
            <input value="{{$key}}" type="radio" name="contenttype">
            <span class="checkmark"></span>
        </label>
      </div>
    @endif
    
    @endforeach
</div>

<style>
.scontainer {
  display: block;
  position: relative;
  padding-left: 30px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.scontainer input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.scontainer .checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.scontainer:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.scontainer input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.scontainer .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.scontainer input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.scontainer .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
</style>