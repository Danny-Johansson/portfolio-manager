<select id="per_page" class="form-select form-control col-1 d-inline me-2" name="per_page" onchange="$('#searchPagnation').submit()">
    <option value="10"<?= @$_GET["per_page"] == 10 ? 'selected' : '' ?>>10</option>
    <option value="25"<?= @$_GET["per_page"] == 25 ? 'selected' : '' ?>>25</option>
    <option value="50" <?= @$_GET["per_page"] == 50 ? 'selected' : '' ?>>50</option>
    <option value="100" <?= @$_GET["per_page"] == 100 ? 'selected' : ''?>>100</option>
</select>
<label for="per_page" class="d-none" aria-hidden="true"></label>
