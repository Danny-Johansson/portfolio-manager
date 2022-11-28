<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="birthday" class="form-label text-capitalize fw-bold">
            @lang('birthday') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="date"
            id="birthday"
            name="birthday"
            class="form-control"
            value="@if(old('birthday')){{old('birthday')}}@elseif(isset($data)){{date("Y-m-d",strtotime($data->birthday))}}@endif"
        >
    </div>
</div>
