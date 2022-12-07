<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="{{$name}}" class="form-label text-capitalize fw-bold">
            @lang("inputs.".$name) :
        </label>
    </div>
    <div class="col-10">
        <input
            type="text"
            name="{{$name}}"
            id="{{$name}}"
            class="form-control"
            placeholder="@lang("inputs.".$name)"
            @if(isset($required))
                required
            @endif
            value="@if(old($name)){{old($name)}}@elseif(isset($data)){{$data->$name}}@endif"
        >
    </div>
</div>
