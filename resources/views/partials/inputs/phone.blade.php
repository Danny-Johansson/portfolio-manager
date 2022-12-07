<div class="row mb-2">
    <div class="col-2">
        <label for="phone" class="form-label text-capitalize fw-bold">
            @lang('phone') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="phone"
            name="phone"
            id="phone"
            class="form-control"
            placeholder="@lang('+45 12 34 56 78')"
            @if(isset($required))
                required
            @endif
            value="@if(old('phone')){{old('phone')}}@elseif(config('system.demo_mode')){{config('system.phone')}}@elseif(isset($data->phone)){{$data->phone}}@endif"
        >
    </div>
</div>
