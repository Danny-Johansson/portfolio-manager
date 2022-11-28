<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="name" class="form-label text-capitalize fw-bold">
            @lang('name') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            placeholder="@lang('name')"
            required
            value="@if(old('name')){{old('name')}}@elseif(isset($data->name)){{$data->name}}@endif"
        >
    </div>
</div>
