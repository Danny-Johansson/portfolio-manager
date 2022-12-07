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
            @if(isset($required))
                required
            @endif
            value="@if(old('email')){{old('email')}}@elseif(config('system.demo_mode')){{config('system.email')}}@elseif(isset($data->email)){{$data->email}}@endif"
        >
    </div>
</div>
