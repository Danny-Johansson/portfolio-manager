<div class="row mt-4">
    <div class="col-2">
        @csrf
    </div>
    <div class="col">
        <button type="submit" class="btn btn-success text-capitalize">
            @lang('system.create') @lang(request()->segment(1).".".$singular)
        </button>
    </div>
</div>

