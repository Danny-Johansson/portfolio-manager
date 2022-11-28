@section('heading')
    @lang($plural)
@endsection

@if(count($data) >= 1)
    <table class="table table-striped table-hover table-bordered  border-4">
        <thead class="text-capitalize fw-bold">
            <td>@lang('name')</td>
            <td>@lang('category')</td>
            <td>@lang('text_color')</td>
            <td>@lang('background_color')</td>
            <td>@lang('border_color')</td>
            <td>@lang('example')</td>
            <td>@lang('action')</td>
        </thead>
        <tbody class="text-capitalize">
            @foreach($data as $object)
                <tr>
                    <td class="col-auto align-middle">
                        {{$object->name}}
                    </td>
                    <td class="col-auto align-middle">
                        @if(isset($object->category))
                            <a href="{{route('tagCategories.show',['tagCategory' => $object->category->id])}}" class="btn btn-outline-success" target="_blank">
                                {{$object->category->name}}
                            </a>
                        @else
                            @lang('None')
                        @endif

                    </td>
                    <td class="col-auto align-middle">
                        <div style="height:1em;width:1em;background-color:{{$object->text_color}};border:1px solid black;display:inline-block;" ></div>
                        {{$object->text_color}}
                    </td>
                    <td class="col-auto align-middle">
                        <div style="height:1em;width:1em;background-color:{{$object->background_color}};border:1px solid black;display:inline-block;" ></div>
                        {{$object->background_color}}
                    </td>
                    <td class="col-auto align-middle">
                        <div style="height:1em;width:1em;background-color:{{$object->border_color}};border:1px solid black;display:inline-block;" ></div>
                        {{$object->border_color}}
                    </td>
                    <td class="col-auto align-middle">
                        <div style="color:{{$object->text_color}};background-color:{{$object->background_color}};border:2px solid {{$object->border_color}};display:inline-block;" class="p-2 rounded-2">
                            @if(!empty($object->category))
                                {{$object->category->name}} :
                            @endif
                            {{$object->name}}
                        </div>
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
