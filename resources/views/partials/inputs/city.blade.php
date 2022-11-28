<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="city" class="form-label text-capitalize fw-bold">
            @lang('city') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="city"
            id="city"
            class="form-control"
            placeholder="@lang('city')"
            value="@if(old('city')){{old('city')}}@elseif(isset($data->city)){{$data->city}}@endif"
        >
    </div>
</div>
