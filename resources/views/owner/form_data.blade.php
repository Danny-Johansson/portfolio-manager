@include('partials.inputs.string',['name' => 'first_name','required' => true])
@include('partials.inputs.string',['name' => 'initials'])
@include('partials.inputs.string',['name' => 'last_name','required' => true])

@include('partials.page_elements.divider')

@include('partials.inputs.birthday')

@include('partials.page_elements.divider')

@include('partials.inputs.email')
@include('partials.inputs.phone')

@include('partials.page_elements.divider')

@include('partials.inputs.string',['name' => 'country'])
@include('partials.inputs.string',['name' => 'city'])
@include('partials.inputs.string',['name' => 'zipcode'])
@include('partials.inputs.string',['name' => 'street_name'])
@include('partials.inputs.string',['name' => 'street_number'])

@include('partials.page_elements.divider')

@include('partials.inputs.checkbox',['name' => 'license'])
