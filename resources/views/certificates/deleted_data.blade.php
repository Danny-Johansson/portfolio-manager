@section('heading')
    @lang('deleted') @lang($plural)
@endsection

@if(count($data) >= 1)
    <table class="table table-striped table-hover table-bordered  border-4">
        <thead class="text-capitalize fw-bold">
            <td>@lang('name')</td>
            <td>@lang('certificateIssuer')</td>
            <td>@lang('earn_date')</td>
            <td>@lang('expire_date')</td>
            <td>@lang('file')</td>
            <td>@lang('note')</td>
            <td>@lang('action')</td>
        </thead>
        <tbody class="text-capitalize">
        @foreach($data as $object)
            <tr>
                <td class="col-auto align-middle">
                    {{$object->name}}
                </td>
                <td class="col-auto align-middle">
                    {{$object->issuer->name}}
                </td>
                <td class="col-auto align-middle">
                    {{date('M Y',strtotime($object->earn_date))}}
                </td>
                <td class="col-auto align-middle">
                    {{date('M Y',strtotime($object->expire_date))}}
                </td>
                <td class="col-auto align-middle">
                    <a href="{{$object->file}}" target="_blank" class="btn btn-outline-success">@lang('file')</a>
                </td>
                <td class="col-auto align-middle">
                    {{$object->note}}
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
