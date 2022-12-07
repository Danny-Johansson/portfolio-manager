<td class="col-{{$col}} align-middle">
    @if(isset($data))
        <a href="{{route($plural.".show",[$singular => $data->id])}}" target="_blank" class="btn btn-outline-success">
            @if(Lang::has($plural.".".$data->name))
                @lang(request()->segment(1).".".$data->name)
            @elseif(Lang::has('inputs.'.$data->name))
                @lang("inputs.".$data->name)
            @elseif(Lang::has('system.'.$data->name))
                @lang("system.".$data->name)
            @else
                {{$data->name}}
            @endif
        </a>
    @else
        @lang('system.none')
    @endif
</td>
