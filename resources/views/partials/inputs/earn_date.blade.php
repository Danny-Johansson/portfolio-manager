<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="earn_date" class="form-label text-capitalize fw-bold">
            @lang('earn_date') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="date"
            id="earn_date"
            name="earn_date"
            class="form-control"
            value="@if(old('earn_date')){{old('earn_date')}}@elseif(isset($data)){{date("Y-m-d",strtotime($data->earn_date))}}@endif"
            required
        >
    </div>
</div>
