@include('partials.page_elements.data.data',['type' => 'skills','data' => $object->name, 'col' => 'auto'])
@include('partials.page_elements.data.data',['type' => 'skillLevels','data' => $object->level->name, 'col' => 'auto'])
