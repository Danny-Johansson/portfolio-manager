<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="experienceType" class="form-label text-capitalize fw-bold">
            @lang('experienceType') :
        </label>
    </div>
    <div class="col-10">
        <select id="experienceType" name="experience_type" class="form-select" >
            @foreach($types as $type)
                <option
                    value="{{$type->id}}"
                    class="text-capitalize"
                    @if(old('tag_category') == $type->id )selected @elseif(isset($data) AND $data->experience_type_id == $type->id)selected @endif
                >@lang($type->name)</option>
            @endforeach
        </select>
    </div>
</div>


