<div class="row mb-2">
    <div class="col-2">
        <label for="logo" class="form-label text-capitalize fw-bold">
            @lang('logo') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="file"
            name="logo"
            id="logo"
            class="form-control"
            placeholder="@lang('logo')"
            required
            value="@if(old('logo')){{old('logo')}}@elseif(isset($data->logo)){{$data->logo}}@endif"
        >
    </div>
</div>
