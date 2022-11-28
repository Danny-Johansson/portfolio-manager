<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="password" class="form-label text-capitalize fw-bold">
            @lang('password') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="password"
            name="password"
            id="password"
            class="form-control"
            placeholder="@lang('password')"
            required
            value="@if(old('password')){{old('password')}}@endif"
        >
    </div>
</div>
