<a href="{{route(request()->segment(1).'.restore',[$singular => $object->id])}}" class="btn btn-success text-capitalize">
    @lang('restore')
</a>
