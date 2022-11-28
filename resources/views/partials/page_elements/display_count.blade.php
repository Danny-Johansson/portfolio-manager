@if($data->appends($_GET)->links() !== null)
    {{$data->appends($_GET)->links('pagination::bootstrap-5')}}
@endif
<!--
<p>
    <span class="text-capitalize">@lang('displaying')</span> {{$data->count()}} @lang('of') {{ $data->total() }} <span class="text-capitalize">
        @if(request()->segment(2) == "deleted")
            @lang('deleted')
        @endif
        @lang($plural)
    </span>.
</p>
-->
