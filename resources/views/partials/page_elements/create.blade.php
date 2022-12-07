<a href="{{route(request()->segment(1).'.create')}}" class="btn btn-success text-capitalize">
    @lang('system.create') @lang(request()->segment(1).".".$singular)
</a>
