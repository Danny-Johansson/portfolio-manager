<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="country" class="form-label text-capitalize fw-bold">
            @lang('country') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="country"
            id="country"
            class="form-control"
            placeholder="@lang('country')"
            value="@if(old('country')){{old('country')}}@elseif(isset($data->country)){{$data->country}}@endif"
        >
    </div>
</div>
