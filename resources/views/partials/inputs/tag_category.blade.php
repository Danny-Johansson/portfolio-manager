<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="tagCategory" class="form-label text-capitalize fw-bold">
            @lang('tagCategory') :
        </label>
    </div>
    <div class="col-10">
        <select id="tagCategory" name="tag_category" class="form-select" >
            <option value="" class="text-capitalize">@lang('None')</option>
            @foreach($categories as $category)
                <option
                    value="{{$category->id}}"
                    class="text-capitalize"
                    data-text_color="{{$category->text_color}}"
                    data-background_color="{{$category->background_color}}"
                    data-border_color="{{$category->border_color}}"
                    @if(old('tag_category') == $category->id )selected @elseif(isset($data) AND $data->tag_category_id == $category->id)selected @endif
                >@lang($category->name)</option>
            @endforeach
        </select>
    </div>
</div>

<script>
    $('#tagCategory').change(function() {
        let text_color = $('#tagCategory').find(":selected").data( "text_color" );
        let background_color = $('#tagCategory').find(":selected").data( "background_color" );
        let border_color = $('#tagCategory').find(":selected").data( "border_color" );
        let option_value = $('#tagCategory').find(":selected").val();

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


