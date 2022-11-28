<div class="row mb-2">
    <div class="col-2 pt-2">
        <label for="border_color" class="form-label text-capitalize fw-bold">
            @lang('border_color') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="color"
            name="border_color_input"
            id="border_color_input"
            class="form-control"
            placeholder="@lang('border_color')"
            required
            value="@if(old('border_color_input')){{old('border_color_input')}}@elseif(isset($data->border_color)){{$data->border_color}}@endif"
            @if(!empty($data->category)) disabled @endif
        >
        <input type="hidden" name="border_color" id="border_color" value="@if(old('border_color')){{old('border_color')}}@elseif(isset($data->border_color)){{$data->border_color}}@endif">
    </div>
</div>
<script>
    $("#border_color_input").input(function() {
        let border_color = $("#border_color_input").val()
        $("#border_color").val(border_color);
    });
</script>
