<button data-toggle="modal" data-target="#deleteModal_{{$object->id}}" class="btn btn-danger  text-capitalize">
    @lang('system.delete')
</button>
<div class="modal" tabindex="-1" role="dialog" id="deleteModal_{{$object->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <h5 class="modal-title text-capitalize">@lang('system.delete') @lang(request()->segment(1).".".$singular)</h5>
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
                <form method="post" action="{{route(Request::segment(1).'.destroy', [$singular => $object->id])}}" id="deleteForm" class="form-inline">
                    @method('delete')
                    @csrf
                    <button  class="btn btn-danger text-capitalize" id="ajaxSubmit">
                        @lang('system.delete')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
