@section('heading')
    @lang($plural)
@endsection

@if(count($data) >= 1)
    <table class="table table-striped table-hover table-bordered  border-4">
        <thead class="text-capitalize fw-bold">
            <td>@lang('name')</td>
            <td>@lang('read')</td>
            <td>@lang('write')</td>
            <td>@lang('speak')</td>
            <td>@lang('understand')</td>
            <td>@lang('action')</td>
        </thead>
        <tbody class="text-capitalize">
            @foreach($data as $object)
                <tr>
                    <td class="col-auto">
                        {{$object->name}}
                    </td>
                    <td class="col-auto">
                        @lang($object->read_rel->name)
                    </td>
                    <td class="col-auto">
                        @lang($object->write_rel->name)
                    </td>
                    <td class="col-auto">
                        @lang($object->speak_rel->name)
                    </td>
                    <td class="col-auto">
                        @lang($object->understand_rel->name)
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