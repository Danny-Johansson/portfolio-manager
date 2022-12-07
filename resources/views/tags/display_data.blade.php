@include('partials.page_elements.data.entity',['singular' => 'tagCategory', 'plural' => 'tagCategories','data' => $object->category,'col' => 'auto'])
@include('partials.page_elements.data.data',['type' => 'tags','data' => $object->name, 'col' => 'auto'])

<td class="col-auto align-middle">
    <div style="height:1em;width:1em;background-color:@if(isset($object->category)){{$object->category->text_color}}@else{{$object->text_color}}@endif;border:1px solid black;display:inline-block;" ></div>
    @if(!empty($object->category))
        {{$object->category->text_color}}
    @else
        {{$object->text_color}}
    @endif
</td>
<td class="col-auto align-middle">
    <div style="height:1em;width:1em;background-color:@if(isset($object->category)){{$object->category->background_color}}@else{{$object->background_color}}@endif;border:1px solid black;display:inline-block;" ></div>
    @if(isset($object->category))
        {{$object->category->background_color}}
    @else
        {{$object->background_color}}
    @endif
</td>
<td class="col-auto align-middle">
    <div style="height:1em;width:1em;background-color:@if(isset($object->category)){{$object->category->border_color}}@else{{$object->border_color}}@endif;border:1px solid black;display:inline-block;" ></div>
    @if(isset($object->category))
        {{$object->category->border_color}}
    @else
        {{$object->border_color}}
    @endif
</td>
<td class="col-auto align-middle">
    <div
        style="
        color:@if(isset($object->category)){{$object->category->text_color}}@else{{$object->text_color}}@endif;
        background-color:@if(isset($object->category)){{$object->category->background_color}}@else{{$object->background_color}}@endif;
        border:2px solid @if(isset($object->category)){{$object->category->border_color}}@else{{$object->border_color}}@endif;
        display:inline-block;" class="p-2 rounded-2">
        @if(!empty($object->category))
            {{$object->category->name}} :
        @endif
        {{$object->name}}
    </div>
</td>
