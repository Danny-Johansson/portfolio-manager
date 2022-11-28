<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="initials" class="form-label text-capitalize fw-bold">
            @lang('initials') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="initials"
            id="initials"
            class="form-control"
            placeholder="@lang('initials')"
            value="@if(old('initials')){{old('initials')}}@elseif(isset($data->initials)){{$data->initials}}@endif"
        >
    </div>
</div>
