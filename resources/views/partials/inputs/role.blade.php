<div class="row mb-2">
    <div class="col-2">
        <label for="role" class="form-label text-capitalize fw-bold">
            @lang('role') :
        </label>
    </div>
    <div class="col-10">
        <select id="role" name="role" class="form-select">
            @foreach($roles as $role)
                <option value="{{$role->id}}" class="text-capitalize" @if(old('role') == $role->id )selected @elseif(isset($data) AND $data->role_id == $role->id)selected @endif>@lang($role->name)</option>
            @endforeach
        </select>
    </div>
</div>
