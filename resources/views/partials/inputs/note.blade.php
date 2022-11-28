<div class="row mb-2">
    <div class="col-2">
        <label for="note" class="form-label text-capitalize fw-bold">
            @lang('note') :
        </label>
    </div>
    <div class="col-10">
        <textarea
            name="note"
            id="note"
            placeholder="@lang('Note')"
            class="form-control"
        >@if(old('note')){{old('note')}}@elseif(isset($data)){{$data->note}}@endif</textarea>
    </div>
</div>
