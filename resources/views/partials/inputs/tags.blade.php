<div class="row mb-2">
    <div class="col-2">
        <label class="form-label text-capitalize fw-bold">
            @lang('tags') :
        </label>
    </div>
    <div class="col-10">
        <table id="tags_table">
            @foreach($tags as $tag)
                <tr>
                    <td class="col-2">
                        <input type="checkbox"
                               class="form-check"
                               name="tags[]"
                               id="tag_{{$tag->id}}"
                               value="{{$tag->id}}"
                               @if(isset($data) AND $data->tags->contains($tag->id)) checked @endif
                        >
                    </td>
                    <td class="col-10">
                        <label for="tag_{{$tag->id}}" class="mt-1 text-capitalize">
                            @if($tag->category)
                                @lang($tag->category->name) :
                            @endif
                            @lang($tag->name)
                        </label>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>

