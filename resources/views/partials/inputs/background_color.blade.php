<div class="row mb-2">
    <div class="col-2 pt-2">
        <label for="background_color" class="form-label text-capitalize fw-bold">
            @lang('background_color') :
        </label>
    </div>
    <div class="col-10">
        <input
            type="color"
            name="background_color_input"
            id="background_color_input"
            class="form-control d-inline-block"
            placeholder="@lang('background_color')"
            required
            value="@if(old('background_color')){{old('background_color')}}@elseif(isset($data->background_color)){{$data->background_color}}@endif"
            @if(!empty($data->category)) disabled @endif
        >
        <input type="hidden" name="background_color" id="background_color" value="">
    </div>
</div>
<script>
    $("#background_color_input").input(function() {
        let background_color = $("#background_color_input").val()
        $("#background_color").val(background_color);
    });
</script>
