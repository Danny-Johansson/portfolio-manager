<div class="row mb-2">
    <div class="col-2">
        <label for="{{$name}}" class="form-label text-capitalize fw-bold">
            @lang($name) :
        </label>
    </div>
    <div class="col-10">
        <input
            type="url"
            name="{{$name}}"
            id="{{$name}}"
            class="form-control"
            placeholder="@lang($name)"
            @if(isset($required))
                required
            @endif
            value="@if(old($name)){{old($name)}}@elseif(config('system.demo_mode')){{config('app.url')}}@elseif(isset($data->$name)){{$data->$name}}@endif"
        >
    </div>
</div>
