<td class="col-{{$col}} align-middle">
    @if(isset($multiline) and $multiline)
        @if(Lang::has($type.".".$data))
            {!! nl2br(__($type.".".$data)) !!}
        @elseif(Lang::has('inputs.'.$data))
            {!! nl2br(__('inputs.'.$data)) !!}
        @elseif(Lang::has('system.'.$data))
            {!! nl2br(__('system.'.$data)) !!}
        @else
            {!! nl2br($data) !!}
        @endif
    @else
        @if(Lang::has($type.".".$data))
            @lang($type.".".$data)
        @elseif(Lang::has('inputs.'.$data))
            @lang("inputs.".$data)
        @elseif(Lang::has('system.'.$data))
            @lang("system.".$data)
        @else
            {{$data}}
        @endif
    @endif

</td>
