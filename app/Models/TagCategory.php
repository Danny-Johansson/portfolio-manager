<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\TagCategory
 *
 * @property int $id
 * @property string $name
 * @property string $background_color
 * @property string $text_color
 * @property string $border_color
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory newQuery()
 * @method static Builder|TagCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory whereBorderColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory whereTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagCategory whereUpdatedAt($value)
 * @method static Builder|TagCategory withTrashed()
 * @method static Builder|TagCategory withoutTrashed()
 * @mixin Eloquent
 */
class TagCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'text_color',
        'background_color',
        'border_color',
    ];
}
