<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="write" class="form-label text-capitalize fw-bold">
            @lang('write') :
        </label>
    </div>
    <div class="col-10">
        <select name="write" id="write" class="form-select">
            @foreach($levels as $level)
                <option
                    value="{{$level->id}}"
                    @if(old('write') == $level->id) selected @elseif(isset($data->write) AND $data->write == $level->id) selected @endif
                >
                    @lang($level->name)
                </option>
            @endforeach
        </select>
    </div>
</div>
