<td class="col-{{$col}}">
    @can(request()->segment(1)."_restore")
        @include('partials.page_elements.restore')
    @endcan
    @can(request()->segment(1)."_deleteForce")
        @include('partials.page_elements.force_delete')
    @endcan
</td>
