<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="understand" class="form-label text-capitalize fw-bold">
            @lang('understand') :
        </label>
    </div>
    <div class="col-10">
        <select name="understand" id="understand" class="form-select">
            @foreach($levels as $level)
                <option
                    value="{{$level->id}}"
                    @if(old('understand') == $level->id) selected @elseif(isset($data->understand) AND $data->understand == $level->id) selected @endif
                >
                    @lang($level->name)
                </option>
            @endforeach
        </select>
    </div>
</div>
