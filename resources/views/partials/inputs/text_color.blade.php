<div class="row mb-2">
    <div class="col-2 pt-2">
        <label for="text_color" class="form-label text-capitalize fw-bold">
            @lang('text_color') :
        </label>
    </div>

    <div class="col-10">
        <input
            type="color"
            name="text_color_input"
            id="text_color_input"
            class="form-control"
            placeholder="@lang('text_color')"
            @if(!isset($colors_nullable))
                required
            @endif
            value="@if(old('text_color')){{old('text_color')}}@elseif(isset($data->text_color)){{$data->text_color}}@endif"
            @if(!empty($data->category)) disabled @endif
        >
        <input type="hidden" name="text_color" id="text_color" value="@if(old('text_color')){{old('text_color')}}@elseif(isset($data->text_color)){{$data->text_color}}@endif">
    </div>
</div>
<script>
    $("#text_color_input").input(function() {
        let text_color = $("#text_color_input").val()
        $("#text_color").val(text_color);
    });
</script>
