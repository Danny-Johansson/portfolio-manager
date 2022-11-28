<input type="text"
       name="search_term"
       placeholder="@lang('search')"
       class="form-control col-3 me-2"
       value="<?= @$_GET["search_term"] ?? ''?>"
>
<label for="search_term" class="d-none" aria-hidden="true"></label>
