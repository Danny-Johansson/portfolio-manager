<div class="row mb-2">
    <div class="col-2">
        <label for="{{$name}}" class="form-label text-capitalize fw-bold">
            @lang("inputs.".$name) :
        </label>
    </div>
    <div class="col-10">
        <textarea
            name="{{$name}}"
            id="{{$name}}"
            placeholder="@lang("inputs.".$name)"
            class="form-control"
            @if(isset($required))
                required
            @endif
        >@if(old($name)){{old($name)}}@elseif(isset($data)){{$data->$name}}@endif</textarea>
    </div>
</div>
