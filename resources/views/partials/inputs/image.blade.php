<div class="row mb-2">
    <div class="col-2">
        <label for="image" class="form-label text-capitalize fw-bold">
            @lang('image') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="file"
            name="image"
            id="image"
            class="form-control"
            placeholder="@lang('image')"
            required
            value="@if(old('image')){{old('image')}}@elseif(isset($data->image)){{$data->image}}@endif"
        >
    </div>
</div>
