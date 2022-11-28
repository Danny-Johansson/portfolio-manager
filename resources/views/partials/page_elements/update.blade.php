<a href="{{route(request()->segment(1).'.edit',[$singular => $object->id])}}" class="btn btn-success text-capitalize">
    @lang('update')
</a>
