<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="street_name" class="form-label text-capitalize fw-bold">
            @lang('street_name') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="street_name"
            id="street_name"
            class="form-control"
            placeholder="@lang('street_name')"
            value="@if(old('street_name')){{old('street_name')}}@elseif(isset($data->street_name)){{$data->street_name}}@endif"
        >
    </div>
</div>
