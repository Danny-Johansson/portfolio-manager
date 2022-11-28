@section('heading')
    @lang('deleted') @lang($plural)
@endsection

@if(count($data) >= 1)
    <table class="table table-striped table-hover table-bordered  border-4">
        <thead class="text-capitalize fw-bold">
            <td>@lang('name')</td>
            <td>@lang('action')</td>
        </thead>
        <tbody class="text-capitalize">
        @foreach($data as $object)
            <tr>
                <td class="col-9">
                    {{$object->name}}
                </td>
                <td class="col-3">
                    @can(request()->segment(1)."_restore")
                        @include('partials.page_elements.restore')
                    @endcan
                    @can(request()->segment(1)."_delete_force")
                        @include('partials.page_elements.force_delete')
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('partials.page_elements.display_count')
@else
    <span class="text-capitalize">
        @lang('no') @lang('deleted') @lang($plural)
    </span>
@endif
