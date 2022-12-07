@include('partials.page_elements.data.data',['type' => 'demonstrations','data' => $object->name, 'col' => 'auto'])
@include('partials.page_elements.data.data',['type' => 'demonstrationTypes','data' => $object->type->name, 'col' => 'auto'])
<td class="col-auto">
    @if(count($object->tags) >= 1)
        @foreach($object->tags as $tag)
            <span style="color:@if(isset($tag->category)){{$tag->category->text_color}}@else{{$tag->text_color}}@endif;background-color:@if(isset($tag->category)){{$tag->category->background_color}}@else{{$tag->background_color}}@endif;border:2px solid @if(isset($tag->category)){{$tag->category->border_color}}@else{{$tag->border_color}}@endif;display:inline-block;" class="p-2 rounded-2 mb-2">
                @if(!empty($tag->category))
                    @if(Lang::has('tagCategories.'.$tag->category->name))
                        @lang('tagCategories.'.$tag->category->name)
                    @else
                        {{$tag->category->name}}
                    @endif
                     :
                @endif
                @if(Lang::has('tags.'.$tag->name))
                    @lang('tags.'.$tag->name)
                @else
                    {{$tag->name}}
                @endif
            </span>
        @endforeach
    @else
        @lang('system.no') @lang('tags.plural')
    @endif
</td>
<td class="col-auto align-middle">
    <button class="btn btn-secondary dropdown-toggle text-capitalize" type="button" id="Showdropdown" data-bs-toggle="dropdown" aria-expanded="false">
        @lang('demonstrationModes.singular')
    </button>
    <ul class="dropdown-menu text-capitalize" aria-labelledby="Showdropdown" style="background:transparent;border:0;">
        @foreach($modes as $mode)
            <li>
                <a
                    href="{{route('demo',[$singular => $object->id,'mode' => $mode->id])}}"
                    class="btn btn-outline-dark bg-light" target="_blank">
                    @if(Lang::has('demonstrationModes.'.$mode->name))
                        @lang('demonstrationModes.'.$mode->name)
                    @else
                        {{$mode->name}}
                    @endif
                </a>
            </li>
        @endforeach
    </ul>
</td>
