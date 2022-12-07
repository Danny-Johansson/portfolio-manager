<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\JobsearchStatus
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|JobsearchStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobsearchStatus newQuery()
 * @method static Builder|JobsearchStatus onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|JobsearchStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobsearchStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobsearchStatus whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobsearchStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobsearchStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobsearchStatus whereUpdatedAt($value)
 * @method static Builder|JobsearchStatus withTrashed()
 * @method static Builder|JobsearchStatus withoutTrashed()
 * @mixin Eloquent
 */
class JobsearchStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
