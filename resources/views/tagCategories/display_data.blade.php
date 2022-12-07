@include('partials.page_elements.data.data',['type' => 'tagCategories','data' => $object->name, 'col' => 'auto'])

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
        {{$object->name}}
    </div>
</td>
