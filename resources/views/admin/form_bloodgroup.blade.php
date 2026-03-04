@php 
$arr_bloodgroup = ['Select','A+','A-','B+','B-','O+','O-','AB+','AB-'];
@endphp
<label class="">Blood Group</label>
<select name="bloodGroup" class="form-select fs-4">
    @for($i=0;$i<sizeof($arr_bloodgroup);$i++)
        @if($value == $i)
            <option selected="selected" value={{$i}}>{{$arr_bloodgroup[$i]}}</option>
        @else
            <option value={{$i}}>{{$arr_bloodgroup[$i]}}</option>
        @endif
    @endfor
</select>