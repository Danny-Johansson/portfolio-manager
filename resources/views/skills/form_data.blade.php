@include('partials.inputs.string',['name' => 'name','required' => true])
@include('partials.inputs.select',['name' => 'skill_level','list' => $levels,'required' => true])
