<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="location" class="form-label text-capitalize fw-bold">
            @lang('location') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="location"
            id="location"
            class="form-control"
            placeholder="@lang('location')"
            required
            value="@if(old('location')){{old('location')}}@elseif(isset($data->location)){{$data->location}}@endif"
        >
    </div>
</div>
