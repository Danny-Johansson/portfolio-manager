<div class="row mb-2">
    <div class="col-2">
        <label for="file" class="form-label text-capitalize fw-bold">
            @lang('file') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="file"
            name="file"
            id="file"
            class="form-control"
            placeholder="@lang('file')"
            required
            value="@if(old('file')){{old('file')}}@elseif(isset($data->file)){{$data->file}}@endif"
        >
    </div>
</div>
