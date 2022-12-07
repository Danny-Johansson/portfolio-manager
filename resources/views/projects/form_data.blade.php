@include('partials.inputs.string',['name' => 'name','required' => true])
@include('partials.inputs.url',['name' => 'repo_url','required' => true])
@include('partials.inputs.url',['name' => 'demo_url','required' => true])
@include('partials.inputs.textarea',['name' => 'note'])

@include('partials.page_elements.row_divider')

@include('partials.inputs.list',['name' => 'features','list' => $features])

@include('partials.page_elements.row_divider')

@include('partials.inputs.list',['name' => 'tags','list' => $tags])

