<div class="row">
    @include('partials.page_elements.label', ['value' => 'image'])
    @include('partials.page_elements.image', ['image' => $data->image,'alt' => 'owner'])
</div>

@include('partials.page_elements.row_divider')

@include('partials.page_elements.data_row', ['label' => 'first_name','data' => $data->first_name])
@include('partials.page_elements.data_row', ['label' => 'initials','data' => $data->initials])
@include('partials.page_elements.data_row', ['label' => 'last_name','data' => $data->last_name])

@include('partials.page_elements.row_divider')

@include('partials.page_elements.data_row', ['label' => 'email','data' => $data->email])
@include('partials.page_elements.data_row', ['label' => 'phone','data' => $data->phone])

@include('partials.page_elements.row_divider')

@include('partials.page_elements.data_row', ['label' => 'country','data' => $data->country])
@include('partials.page_elements.data_row', ['label' => 'city','data' => $data->city])
@include('partials.page_elements.data_row', ['label' => 'zipcode','data' => $data->zip])
@include('partials.page_elements.data_row', ['label' => 'street_name','data' => $data->street_name])
@include('partials.page_elements.data_row', ['label' => 'street_number','data' => $data->street_number])

@include('partials.page_elements.row_divider')

<div class="row">
    @include('partials.page_elements.label', ['value' => 'license'])
    @include('partials.page_elements.data_boolean', ['boolean' => $data->license])
</div>

