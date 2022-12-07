@include('partials.page_elements.data.data',['type' => 'users','data' => $object->name, 'col' => 'auto'])
@include('partials.page_elements.data.email',['data' => $object->email, 'col' => 'auto'])
@include('partials.page_elements.data.entity',['plural' => 'roles','singular' => 'role','data' => $object->role, 'col' => 'auto'])
