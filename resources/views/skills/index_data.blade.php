@section('heading')
    @lang($plural)
@endsection

@if(count($data) >= 1)
    <table class="table table-striped table-hover table-bordered  border-4">
        <thead class="text-capitalize fw-bold">
            <td>@lang('name')</td>
            <td>@lang('skillLevel')</td>
            <td>@lang('action')</td>
        </thead>
        <tbody class="text-capitalize">
            @foreach($data as $object)
                <tr>
                    <td class="col-auto">
                        {{$object->name}}
                    </td>
                    <td class="col-auto">
                        {{$object->level->name}}
                    </td>
                    <td class="col-2">
                        @can(request()->segment(1)."_update")
                            @include('partials.page_elements.update')
                        @endcan
                        @can(request()->segment(1)."_delete")
                            @include('partials.page_elements.delete')
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('partials.page_elements.display_count')
@else
    <span class="text-capitalize">
        @lang('no') @lang($plural)
    </span>
@endif
