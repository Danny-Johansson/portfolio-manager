<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="license" class="form-label text-capitalize fw-bold">
            @lang('license') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="checkbox"
            id="license"
            name="license"
            class="form-check-inline"
            style="height:1.5em;width:1.5em;"
            @if(old('license')) checked @elseif(isset($data) AND $data->license == true) checked @endif
        >
    </div>
</div>
