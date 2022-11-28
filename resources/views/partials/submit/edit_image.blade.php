<div class="row mt-4">
    <div class="col-2">
        @csrf
        @method('put')
    </div>
    <div class="col">
        <button type="submit" class="btn btn-success text-capitalize">
            @lang('update') @lang($singular) @lang('image')
        </button>
    </div>
</div>
