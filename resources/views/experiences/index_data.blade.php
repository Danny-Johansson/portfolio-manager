@section('heading')
    @lang($plural)
@endsection

@if(count($data) >= 1)
    <table class="table table-striped table-hover table-bordered  border-4">
        <thead class="text-capitalize fw-bold">
            <td>@lang('name')
            <td>@lang('location')</td>
            <td>@lang('type')</td>
            <td>@lang('start_date')</td>
            <td>@lang('end_date')</td>
            <td>@lang('note')</td>
            <td>@lang('action')</td>
        </thead>
        <tbody class="text-capitalize">
            @foreach($data as $object)
                <tr>
                    <td class="col-auto">
                        {{$object->name}}
                    </td>
                    <td class="col-auto">
                        {{$object->location}}
                    </td>
                    <td class="col-auto">
                        {{$object->type->name}}
                    </td>
                    <td class="col-auto">
                        {{date("d M Y",strtotime($object->start_date))}}
                    </td>
                    <td class="col-auto">
                        {{date("d M Y",strtotime($object->end_date))}}
                    </td>
                    <td class="col-auto">
                        {!! nl2br($object->note) !!}
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
