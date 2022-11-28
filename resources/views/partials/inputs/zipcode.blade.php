<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="zipcode" class="form-label text-capitalize fw-bold">
            @lang('zipcode') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="zipcode"
            id="zipcode"
            class="form-control"
            placeholder="@lang('zipcode')"
            value="@if(old('zipcode')){{old('zipcode')}}@elseif(isset($data)){{$data->zip}}@endif"
        >
    </div>
</div>
