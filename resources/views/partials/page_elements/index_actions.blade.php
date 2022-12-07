<td class="col-{{$col}} align-middle">
    @can(request()->segment(1)."_update")
        @include('partials.page_elements.update')
    @endcan
    @if(isset($additional_update))
        @can(request()->segment(1)."_update")
            @include('partials.page_elements.update_'.$additional_update)
        @endcan
    @endif
    @can(request()->segment(1)."_delete")
        @include('partials.page_elements.delete')
    @endcan
</td>
