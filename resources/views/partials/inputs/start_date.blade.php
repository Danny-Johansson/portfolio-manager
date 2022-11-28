<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="start_date" class="form-label text-capitalize fw-bold">
            @lang('start_date') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="date"
            id="start_date"
            name="start_date"
            class="form-control"
            value="@if(old('start_date')){{old('start_date')}}@elseif(isset($data)){{date("Y-m-d",strtotime($data->start_date))}}@endif"
            required
        >
    </div>
</div>
