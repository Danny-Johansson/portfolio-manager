<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="{{$name}}" class="form-label text-capitalize fw-bold">
            @lang($name) :
        </label>
    </div>
    <div class="col-10">
        <input
            type="checkbox"
            id="{{$name}}"
            name="{{$name}}"
            class="form-check mt-2"
            @if(old($name)) checked @elseif(isset($data) AND $data->$name == true) checked @endif
        >
    </div>
</div>
