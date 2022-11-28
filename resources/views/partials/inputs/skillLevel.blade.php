<div class="row mb-2">
    <div class="col-2">
        <label for="role" class="form-label text-capitalize fw-bold">
            @lang('skillLevel') :
        </label>
    </div>
    <div class="col-10">
        <select id="skill_level" name="skill_level" class="form-select">
            @foreach($levels as $level)
                <option value="{{$level->id}}" class="text-capitalize" @if(old('skill_level') == $level->id )selected @elseif(isset($data) AND $data->skill_level_id == $level->id)selected @endif>@lang($level->name)</option>
            @endforeach
        </select>
    </div>
</div>
