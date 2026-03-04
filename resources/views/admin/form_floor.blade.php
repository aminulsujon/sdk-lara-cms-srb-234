@php 
$arr_floor = ['Select','Ground','First','Second','Third'];
@endphp
<label class="">Floor Central</label>
<select name="floorCentral" class="form-select fs-4">
    @for($i=0;$i<sizeof($arr_floor);$i++)
        @if($value == $i)
            <option selected="selected" value={{$i}}>{{$arr_floor[$i]}}</option>
        @else
            <option value={{$i}}>{{$arr_floor[$i]}}</option>
        @endif
        
    @endfor
</select>