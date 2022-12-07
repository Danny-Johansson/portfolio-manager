<a href="{{route(request()->segment(1).'.file.form',[$singular => $object->id])}}" class="btn btn-success text-capitalize">
    @lang('system.update') @lang('inputs.file')
</a>
