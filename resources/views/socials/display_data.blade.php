@include('partials.page_elements.data.data',['type' => 'socials','data' => $object->name, 'col' => 'auto'])
@include('partials.page_elements.data.link',['label' => $object->link,'data' => $object->link, 'col' => 'auto'])
<td class="col-auto align-middle">
    <img src="{{$object->logo}}" alt="@include('partials.page_elements.data.inline_data',['type' => 'socials','data' => $object->name ])" class="img-thumbnail border-1">
</td>
