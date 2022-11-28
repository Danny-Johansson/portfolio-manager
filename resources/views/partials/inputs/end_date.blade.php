<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="end_date" class="form-label text-capitalize fw-bold">
            @lang('end_date') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="date"
            id="end_date"
            name="end_date"
            class="form-control"
            value="@if(old('end_date')){{old('end_date')}}@elseif(isset($data)){{date("Y-m-d",strtotime($data->end_date))}}@endif"
            required
        >
    </div>
</div>
