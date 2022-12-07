@include('partials.inputs.string',['name' => 'name','required' => true])
@include('partials.inputs.file',['name' => 'file','required' => true,'accept' => '.html,.htm'])
@include('partials.inputs.select',['name' => 'demonstration_type','list' => $types,'required' => true])
@include('partials.inputs.list',['name' => 'tags','list' => $tags])
