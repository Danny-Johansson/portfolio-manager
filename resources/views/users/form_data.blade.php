@include('partials.inputs.string',['name' => 'name','required' => true])
@include('partials.inputs.select',['singular' => 'role','plural' => 'roles','list' => $roles,'required' => true])
@include('partials.inputs.email')
@include('partials.inputs.password')
