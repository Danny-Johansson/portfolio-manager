<div class="row mb-2">
    <div class="col-2">
        <label for="role" class="form-label text-capitalize fw-bold">
            @lang('certificateIssuer') :
        </label>
    </div>
    <div class="col-10">
        <select id="certificate_issuer" name="certificate_issuer" class="form-select">
            @foreach($issuers as $issuer)
                <option value="{{$issuer->id}}" class="text-capitalize" @if(old('certificate_issuer') == $issuer->id )selected @elseif(isset($data) AND $data->certificate_issuer_id == $issuer->id)selected @endif>@lang($issuer->name)</option>
            @endforeach
        </select>
    </div>
</div>
