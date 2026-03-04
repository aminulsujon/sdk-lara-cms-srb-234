<form action="{{$action}}" method="post">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
</form>