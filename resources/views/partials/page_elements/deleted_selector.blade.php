<span class="col-auto mt-2 text-capitalize">@lang('list') : </span>
<button class="btn btn-secondary dropdown-toggle col-2 text-capitalize" type="button" id="Showdropdown" data-bs-toggle="dropdown" aria-expanded="false">
    @lang('select')
</button>
<ul class="dropdown-menu col-2 text-capitalize" aria-labelledby="Showdropdown">
    @if(Request::is(Request::segment(1)))
        @can(Request::segment(1)."_deleted")
            <li><a class="dropdown-item" href="{{Request::segment(1)}}/deleted">@lang('deleted')</a></li>
        @endcan
    @else
        <li><a class="dropdown-item" href="{{Route(Request::segment(1).".index")}}">@lang('active')</a></li>
    @endif
</ul>
