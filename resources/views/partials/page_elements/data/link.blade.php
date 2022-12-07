<td class="col-{{$col}} align-middle">
    @if(config('system.demo_mode'))
        <a href="{{config('app.url')}}" target="_blank" class="btn btn-outline-success">
            {{config('app.url')}}
        </a>
    @else
        <a href="{{$data}}" target="_blank" class="btn btn-outline-success">
            @if(Lang::has(request()->segment(1).".".$label))
                @lang(request()->segment(1).".".$label)
            @elseif(Lang::has('inputs.'.$label))
                @lang("inputs.".$label)
            @elseif(Lang::has('system.'.$label))
                @lang("system.".$label)
            @else
                {{$label}}
            @endif
        </a>
    @endif
</td>
