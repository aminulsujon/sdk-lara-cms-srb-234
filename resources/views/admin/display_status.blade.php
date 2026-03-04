@php 
$arr_status = ['Select','Active','Inactive','Pending'];
@endphp

<span class="badge badge-info status-{{ $value }}">{{ $arr_status[$value] }}</span>