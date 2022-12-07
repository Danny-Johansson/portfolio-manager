<a href="{{route(request()->segment(1).'.logo.form',[$singular => $object->id])}}" class="btn btn-success text-capitalize">
    @lang('system.update') @lang('inputs.logo')
</a>
