<h{{$level}} class="text-capitalize @if(isset($textcenter)) text-center @endif mb-4 mt-4">
    @if(Lang::has($type.".".$data))
        @lang($type.".".$data)
    @elseif(Lang::has('inputs.'.$data))
        @lang("inputs.".$data)
    @elseif(Lang::has('system.'.$data))
        @lang("system.".$data)
    @else
        {{$data}}
    @endif
</h{{$level}}>
