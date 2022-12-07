<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\JobsearchType
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|JobsearchType newModelQuery()
 * @method static Builder|JobsearchType newQuery()
 * @method static \Illuminate\Database\Query\Builder|JobsearchType onlyTrashed()
 * @method static Builder|JobsearchType query()
 * @method static Builder|JobsearchType whereCreatedAt($value)
 * @method static Builder|JobsearchType whereDeletedAt($value)
 * @method static Builder|JobsearchType whereId($value)
 * @method static Builder|JobsearchType whereName($value)
 * @method static Builder|JobsearchType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|JobsearchType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|JobsearchType withoutTrashed()
 * @mixin Eloquent
 */
class JobsearchType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
