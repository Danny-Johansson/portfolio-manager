<div class="row mb-2">
    <div class="col-2">
        <label for="{{$name}}" class="form-label text-capitalize fw-bold">
            @lang("inputs.".$name) :
        </label>
    </div>
    <div class="col-10">
        <input
            type="file"
            name="{{$name}}"
            id="{{$name}}"
            class="form-control"
            placeholder="@lang("inputs.".$name)"
            value="@if(old($name)){{old($name)}}@elseif(isset($data->$name)){{$data->$name}}@endif"
            @if(isset($required))
                required
            @endif
            @if(isset($accept))
                accept="{{$accept}}"
            @endif
        >
    </div>
</div>
