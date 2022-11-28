<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="last_name" class="form-label text-capitalize fw-bold">
            @lang('last_name') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="last_name"
            id="last_name"
            class="form-control"
            placeholder="@lang('last_name')"
            value="@if(old('last_name')){{old('last_name')}}@elseif(isset($data->last_name)){{$data->last_name}}@endif"
        >
    </div>
</div>
