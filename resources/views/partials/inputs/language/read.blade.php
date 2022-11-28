<div class="row mb-2">
    <div class="col-2 pt-1">
        <label for="read" class="form-label text-capitalize fw-bold">
            @lang('read') :
        </label>
    </div>
    <div class="col-10">
        <select name="read" id="read" class="form-select">
            @foreach($levels as $level)
                <option
                    value="{{$level->id}}"
                    @if(old('read') == $level->id) selected @elseif(isset($data->read) AND $data->read == $level->id) selected @endif
                >
                    @lang($level->name)
                </option>
            @endforeach
        </select>
    </div>
</div>
