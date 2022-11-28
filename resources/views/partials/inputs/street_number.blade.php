<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="street_numbername" class="form-label text-capitalize fw-bold">
            @lang('street_number') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="street_number"
            id="street_number"
            class="form-control"
            placeholder="@lang('street_number')"
            value="@if(old('street_number')){{old('street_number')}}@elseif(isset($data->street_number)){{$data->street_number}}@endif"
        >
    </div>
</div>
