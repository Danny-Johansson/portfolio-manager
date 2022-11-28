<div class="row mb-2">
    <div class="col-2">
        <label for="email" class="form-label text-capitalize fw-bold">
            @lang('email') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            placeholder="@lang('email@domain.tld')"
            required
            value="@if(old('email')){{old('email')}}@elseif(isset($data->email)){{$data->email}}@endif"
        >
    </div>
</div>
