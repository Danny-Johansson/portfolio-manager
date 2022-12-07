<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\DemonstrationType
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|DemonstrationType newModelQuery()
 * @method static Builder|DemonstrationType newQuery()
 * @method static \Illuminate\Database\Query\Builder|DemonstrationType onlyTrashed()
 * @method static Builder|DemonstrationType query()
 * @method static Builder|DemonstrationType whereCreatedAt($value)
 * @method static Builder|DemonstrationType whereDeletedAt($value)
 * @method static Builder|DemonstrationType whereId($value)
 * @method static Builder|DemonstrationType whereName($value)
 * @method static Builder|DemonstrationType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|DemonstrationType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DemonstrationType withoutTrashed()
 * @mixin Eloquent
 */
class DemonstrationType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
