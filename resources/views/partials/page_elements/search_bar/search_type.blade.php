<select name="search_type" id="search_type" class="form-select col-1 me-2" style="width:100%" required>
    @foreach($search_types as $search_type)
        <option
            class="text-capitalize"
            value="{{$search_type['value']}}"
            @if(isset($_GET['search_type']) && $_GET['search_type'] == $search_type['value']) selected @endif
        >
            @lang("inputs.".$search_type['name'])
        </option>
    @endforeach
</select>
<label for="search_type" class="d-none" aria-hidden="true"></label>
