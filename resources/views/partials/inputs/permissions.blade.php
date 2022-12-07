<div class="row mb-2">
    <div class="col-2">
        <label class="form-label text-capitalize fw-bold">
            @lang('system.permissions') :
        </label>
    </div>
    <div class="col-10">
        @php
            $parts_used = [];
        @endphp
        <table id="permissions_table">
            @foreach($permissions as $permission)
                @php
                    $parts = explode("_",$permission->name);

                    $parts_used = array_unique($parts_used);
                @endphp
                <tr @if(!in_array($parts[0],$parts_used) && !$loop->first)class="border-top" @endif>
                    <td class="col-2">
                        <input type="checkbox"
                               class="form-check"
                               name="permissions[]"
                               id="permission_{{$permission->id}}"
                               value="{{$permission->id}}"
                               @if(isset($data) AND $data->permissions->contains($permission->id)) checked @endif
                        >
                    </td>
                    <td class="col-10">
                        <label for="permission_{{$permission->id}}" class="mt-1 text-capitalize">
                            @for($i = 0;$i <= count($parts) - 1;$i++)
                                @switch($i)
                                    @case(0)
                                        @lang($parts[0].".plural")
                                        @break
                                    @case(1)
                                        @lang("system.".$parts[$i])
                                        @break
                                @endswitch

                            @endfor
                        </label>
                    </td>
                    <td>

                    </td>
                    @php
                        array_push($parts_used,$parts[0]);
                    @endphp
                </tr>
            @endforeach
        </table>
    </div>
</div>

