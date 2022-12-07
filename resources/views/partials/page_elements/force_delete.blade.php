<button data-toggle="modal" data-target="#forcedeleteModal_{{$object->id}}" class="btn btn-danger  text-capitalize">
    @lang('system.forceDelete')
</button>
<div class="modal" tabindex="-1" role="dialog" id="forcedeleteModal_{{$object->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <h5 class="modal-title text-capitalize">@lang('system.forceDelete') @lang(request()->segment(1).".".$singular)</h5>
                <button type="button" class="btn btn-close close fold" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @lang(request()->segment(1).".".$singular) :
                @if(!empty($object->name))
                    {{$object->name}}
                @else
                    {{$object->id}}
                @endif
            </div>
            <div class="modal-footer">
                <form method="post" action="{{route(Request::segment(1).'.forceDelete', [$singular => $object->id])}}" id="forcedeleteForm" class="form-inline">
                    @method('delete')
                    @csrf
                    <button  class="btn btn-danger text-capitalize" id="ajaxSubmit">
                        @lang('system.forceDelete')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
