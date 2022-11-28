<a href="{{route(request()->segment(1).'.edit',['owner' => $data->id])}}" class="btn btn-success text-capitalize">
    @lang('update') @lang('data')
</a>
