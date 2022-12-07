@php
    $item_id = $singular."_id";
@endphp
<div class="row mb-2">
    <div class="col-2">
        <label for="{{$singular}}" class="form-label text-capitalize fw-bold">
            @lang("inputs.".$singular) :
        </label>
    </div>
    <div class="col-10">
        <select id="{{$singular}}" name="{{$singular}}" class="form-select" @if(isset($required)) required @endif>
            @if(isset($with_none))
                <option value="" class="text-capitalize" @if(old($singular) == "")selected @elseif(isset($data) AND $data->$item_id == "")selected @endif>@lang("None")</option>
            @endif
            @foreach($list as $item)
                <option
                    value="{{$item->id}}"
                    class="text-capitalize"
                    @if($singular == "tag_category")
                        data-text_color="{{$item->text_color}}"
                        data-background_color="{{$item->background_color}}"
                        data-border_color="{{$item->border_color}}"
                    @endif
                    @if(old($singular) == $item->id )selected @elseif(isset($data) AND $data->$item_id == $item->id)selected @endif
                >
                    @if(Lang::has($plural.".".$item->name))
                        @lang($plural.".".$item->name)
                    @else
                        {{$item->name}}
                    @endif
                </option>
            @endforeach
        </select>
    </div>
</div>
@if($singular == 'tag_category')
    <script>
        $('#tag_category').change(function() {
            let text_color = $('#tag_category').find(":selected").data( "text_color" );
            let background_color = $('#tag_category').find(":selected").data( "background_color" );
            let border_color = $('#tag_category').find(":selected").data( "border_color" );
            let option_value = $('#tag_category').find(":selected").val();

            if(!option_value){
                $('#text_color_input').prop('required',true);
                $('#text_color_input').prop('disabled',false);
                $('#text_color_input').val("#000000")
                $('#background_color_input').prop('required',true);
                $('#background_color_input').prop('disabled',false);
                $('#background_color_input').val("#FFFFFF");
                $('#border_color_input').prop('required',true);
                $('#border_color_input').prop('disabled',false);
                $('#border_color_input').val("#000000")
            }
            else{
                $('#text_color_input').prop('disabled',true);
                $('#background_color_input').prop('disabled',true);
                $('#border_color_input').prop('disabled',true);
                $('#text_color_input').val(text_color);
                $('#background_color_input').val(background_color);
                $('#border_color_input').val(border_color);
                $('#text_color').val(text_color);
                $('#background_color').val(background_color);
                $('#border_color').val(border_color);
            }
        });
    </script>
@endif
