<div class="row mt-4">
    <div class="col-2">
        @csrf
        @method('put')
    </div>
    <div class="col">
        <button type="submit" class="btn btn-success text-capitalize">
            @lang('edit') @lang(request()->segment(1).".".$singular)
        </button>
    </div>
</div>
