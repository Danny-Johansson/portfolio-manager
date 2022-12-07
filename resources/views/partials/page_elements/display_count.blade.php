@if($data->appends($_GET)->links() !== null)
    {{$data->appends($_GET)->links('pagination::bootstrap-5')}}
@endif
