<select name="search_compare" id="search_compare" class="form-select col-1 me-2" required>
    <option value="like" @if(isset($_GET['search_compare']) && $_GET['search_compare'] == 'like') selected @endif>~</option>
    <option value=">" @if(isset($_GET['search_compare']) && $_GET['search_compare'] == '>') selected @endif>></option>
    <option value=">=" @if(isset($_GET['search_compare']) && $_GET['search_compare'] == '>=') selected @endif>>=</option>
    <option value="=" @if(isset($_GET['search_compare']) && $_GET['search_compare'] == '=') selected @endif>=</option>
    <option value="<=" @if(isset($_GET['search_compare']) && $_GET['search_compare'] == '=<') selected @endif><=</option>
    <option value="<=" @if(isset($_GET['search_compare']) && $_GET['search_compare'] == '<') selected @endif><</option>
</select>
<label for="search_compare" class="d-none" aria-hidden="true"></label>
