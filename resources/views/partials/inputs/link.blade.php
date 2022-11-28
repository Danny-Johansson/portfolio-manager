<div class="row mb-2">
    <div class="col-2">
        <label for="link" class="form-label text-capitalize fw-bold">
            @lang('link') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="url"
            name="link"
            id="link"
            class="form-control"
            placeholder="@lang('link')"
            required
            value="@if(old('link')){{old('link')}}@elseif(isset($data->link)){{$data->link}}@endif"
        >
    </div>
</div>
