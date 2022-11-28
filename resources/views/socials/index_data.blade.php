@section('heading')
    @lang($plural)
@endsection

@if(count($data) >= 1)
    <table class="table table-striped table-hover table-bordered  border-4">
        <thead class="text-capitalize fw-bold">
            <td>@lang('name')</td>
            <td>@lang('link')</td>
            <td>@lang('logo')</td>
            <td>@lang('action')</td>
        </thead>
        <tbody class="text-capitalize">
            @foreach($data as $object)
                <tr class="align-middle">
                    <td class="col-auto">
                        {{$object->name}}
                    </td>
                    <td class="col-auto">
                        <a href="@if(config('system.demo_mode')){{config('app.url')}}@else{{$object->link}}@endif" target="_blank" class="btn btn-outline-success">
                            @if(config('system.demo_mode')){{config('app.url')}}@else{{$object->link}}@endif
                        </a>
                    </td>
                    <td class="col-auto align-middle">
                        <img src="{{$object->logo}}" alt="{{$object->name}}" class="img-thumbnail border-1">
                    </td>
                    <td class="col-3">
                        @can(request()->segment(1)."_update")
                            @include('partials.page_elements.update')
                        @endcan
                            @can(request()->segment(1)."_update")
                                <a href="{{route('socials.logo.form',['social' => $object->id])}}" class="btn btn-success">
                                    @lang('update') @lang('logo')
                                </a>
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
