<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="speak" class="form-label text-capitalize fw-bold">
            @lang('speak') :
        </label>
    </div>
    <div class="col-10">
        <select name="speak" id="speak" class="form-select">
            @foreach($levels as $level)
                <option
                    value="{{$level->id}}"
                    @if(old('speak') == $level->id) selected @elseif(isset($data->speak) AND $data->speak == $level->id) selected @endif
                >
                    @lang($level->name)
                </option>
            @endforeach
        </select>
    </div>
</div>
