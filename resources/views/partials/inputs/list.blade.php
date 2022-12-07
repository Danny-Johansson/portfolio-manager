<div class="row mb-2">
    <div class="col-2">
        <label class="form-label text-capitalize fw-bold">
            @lang($name.".plural") :
        </label>
    </div>
    <div class="col-10">
        <ul class="list-unstyled">
            @foreach($list as $item)
                <li>
                    <input type="checkbox"
                           class="form-check-inline"
                           name="{{$name}}[]"
                           id="{{$name}}_{{$item->id}}"
                           value="{{$item->id}}"
                           @if(isset($data) AND $data->$name->contains($item->id)) checked @endif
                    >
                    <label for="{{$name}}_{{$item->id}}" class="mt-1 text-capitalize">
                            @if($item->category)
                                @lang($item->category->name) :
                            @endif
                        @lang($item->name)
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>

