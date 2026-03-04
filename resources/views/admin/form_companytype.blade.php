@php 
$arr_companytype = [
    'Select Business Type',
    'Business Process Outsourcing',
    'Computer Hardware',
    'Computer Networking',
    'Content Provider/ Infotainment',
    'E-Commerce/Web services',
    'E-Learning',
    'Enterprise Solution',
    'Internet Service Provider',
    'IT Enabled Services (ITES)',
    'Manufacturing / Trading',
    'Mobile application',
    'Multimedia Production',
    'Reseller/Value added reseller',
    'Retail Technologies',
    'Software',
    'Software Development',
    'Telecommunication Services',
    'Training'
    ];
@endphp
<label class="">Company Type</label>
<select name="companyType" class="form-control form-select">
    @for($i=0;$i<sizeof($arr_companytype);$i++)
        @if($value == $i)
            <option selected="selected" value={{$i}}>{{$arr_companytype[$i]}}</option>
        @else
            <option value={{$i}}>{{$arr_companytype[$i]}}</option>
        @endif
        
    @endfor
</select>