<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="first_name" class="form-label text-capitalize fw-bold">
            @lang('first_name') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="first_name"
            id="first_name"
            class="form-control"
            placeholder="@lang('first_name')"
            value="@if(old('first_name')){{old('first_name')}}@elseif(isset($data->first_name)){{$data->first_name}}@endif"
        >
    </div>
</div>
