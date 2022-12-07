<td class="col-{{$col}} align-middle">
    @if(count($data) >= 1)
        @if($style == "ordered") <ol> @elseif($style == "tags") @else <ul> @endif
            @foreach($data as $item)
                @if($style == "tags")
                    <span style="color:@if(isset($item->category)){{$item->category->text_color}}@else{{$item->text_color}}@endif;background-color:@if(isset($item->category)){{$item->category->background_color}}@else{{$item->background_color}}@endif;border:2px solid @if(isset($item->category)){{$item->category->border_color}}@else{{$item->border_color}}@endif;display:inline-block;" class="p-2 rounded-2 mb-2">
                @else
                    <li>
                @endif
                    @if(Lang::has($type.".".$item->name))
                        @lang(request()->segment(1).".".$item->name)
                    @elseif(Lang::has('inputs.'.$item->name))
                        @lang("inputs.".$item->name)
                    @elseif(Lang::has('system.'.$item->name))
                        @lang("system.".$item->name)
                    @else
                        {{$item->name}}
                    @endif
                @if($style == "tags")
                    </span>
                @else
                    </li>
                @endif
            @endforeach
                @if($style == "ordered") </ol> @elseif($style == "tags") @else </ul> @endif
    @else
        @lang('system.no') @lang($type."plural")
    @endif
</td>
