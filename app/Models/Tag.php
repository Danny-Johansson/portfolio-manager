<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string|null $background_color
 * @property string|null $text_color
 * @property string|null $border_color
 * @property int|null $tag_category_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read TagCategory|null $category
 * @property-read Model|Eloquent $taggable
 * @method static Builder|Tag newModelQuery()
 * @method static Builder|Tag newQuery()
 * @method static \Illuminate\Database\Query\Builder|Tag onlyTrashed()
 * @method static Builder|Tag query()
 * @method static Builder|Tag whereBackgroundColor($value)
 * @method static Builder|Tag whereBorderColor($value)
 * @method static Builder|Tag whereCreatedAt($value)
 * @method static Builder|Tag whereDeletedAt($value)
 * @method static Builder|Tag whereId($value)
 * @method static Builder|Tag whereName($value)
 * @method static Builder|Tag whereTagCategoryId($value)
 * @method static Builder|Tag whereTextColor($value)
 * @method static Builder|Tag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Tag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Tag withoutTrashed()
 * @mixin Eloquent
 */
class Tag extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'tag_category_id',
        'text_color',
        'background_color',
        'border_color',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TagCategory::class,'tag_category_id');
    }
}
