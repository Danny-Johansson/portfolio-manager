<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="expire_date" class="form-label text-capitalize fw-bold">
            @lang('expire_date') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="date"
            id="expire_date"
            name="expire_date"
            class="form-control"
            value="@if(old('expire_date')){{old('expire_date')}}@elseif(isset($data)){{date("Y-m-d",strtotime($data->expire_date))}}@endif"
            required
        >
    </div>
</div>
