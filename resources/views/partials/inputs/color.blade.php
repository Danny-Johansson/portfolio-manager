@php
    $var = $type."_color";
    $input = $var."_input";
@endphp
<div class="row mb-2">
    <div class="col-2 pt-2">
        <label for="$var" class="form-label text-capitalize fw-bold">
            @lang("inputs.".$var) :
        </label>
    </div>
    <div class="col-10">
        <input
            type="color"
            name="{{$input}}"
            id="{{$input}}"
            class="form-control d-inline-block"
            placeholder="@lang("inputs.".$var)"
            @if(isset($required))
                required
            @endif
            value="@if(old($type."_color")){{old($type."_color")}}@elseif(isset($data->$var)){{$data->$var}}@endif"
            @if(!empty($data->category)) disabled @endif
        >
        <input type="hidden" name="{{$var}}" id="{{$var}}" value="@if(old($var)){{old($var)}}@elseif(isset($data->$var)){{$data->$var}}@endif">
    </div>
</div>
<script>
    $("#" + {!! json_encode($type) !!} + "_color_input").change(function(){
            $("#" + {!! json_encode($type) !!} + "_color").val($("#" + {!! json_encode($type) !!} + "_color_input").val());
    });
</script>
