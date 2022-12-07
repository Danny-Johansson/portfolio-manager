<div class="row mb-2">
    @php
        $var = $type.'_date';
    @endphp
    <div class="col-2 pt-1">
        <label for="{{$var}}" class="form-label text-capitalize fw-bold">
            @lang("inputs.".$var) :
        </label>
    </div>
    <div class="col-10">
        <input
            type="date"
            id="{{$var}}"
            name="{{$var}}"
            @if(isset($min))
                min="{{$min}}"
            @endif
            @if(isset($max))
                max="{{$max}}"
            @endif
            class="form-control"
            value="@if(old($var)){{old($var)}}@elseif(isset($data)){{date("Y-m-d",strtotime($data->$var))}}@endif"
            @if(isset($required))
                required
            @endif
        >
    </div>
</div>
