<td class="col-{{$col}} align-middle">
    @if(config('system.demo_mode'))
        {{config('system.email')}}
     @else
        {{$data}}
    @endif
</td>
