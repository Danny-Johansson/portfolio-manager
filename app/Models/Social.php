<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Social
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $logo
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|Social newModelQuery()
 * @method static Builder|Social newQuery()
 * @method static \Illuminate\Database\Query\Builder|Social onlyTrashed()
 * @method static Builder|Social query()
 * @method static Builder|Social whereCreatedAt($value)
 * @method static Builder|Social whereDeletedAt($value)
 * @method static Builder|Social whereId($value)
 * @method static Builder|Social whereLink($value)
 * @method static Builder|Social whereLogo($value)
 * @method static Builder|Social whereName($value)
 * @method static Builder|Social whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Social withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Social withoutTrashed()
 * @mixin Eloquent
 */
class Social extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'link',
        'logo'
    ];
}
