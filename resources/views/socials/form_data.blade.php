@include('partials.inputs.string',['name' => 'name','required' => true])
@include('partials.inputs.url',['name' => 'link','required' => true])
@include('partials.inputs.file',['name' => 'logo','required' => true,'accept' => 'image/*'])
