<span @if(isset($id)) id="{{$id}}" @endif class="fw-bold text-capitalize">
    @if(Lang::has($type.".".$data))
        @lang($type.".".$data)
    @elseif(Lang::has('inputs.'.$data))
        @lang("inputs.".$data)
    @elseif(Lang::has('system.'.$data))
        @lang("system.".$data)
    @else
        {{$data}}
    @endif
    :
</span>
