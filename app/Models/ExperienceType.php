<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\ExperienceType
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|ExperienceType newModelQuery()
 * @method static Builder|ExperienceType newQuery()
 * @method static \Illuminate\Database\Query\Builder|ExperienceType onlyTrashed()
 * @method static Builder|ExperienceType query()
 * @method static Builder|ExperienceType whereCreatedAt($value)
 * @method static Builder|ExperienceType whereDeletedAt($value)
 * @method static Builder|ExperienceType whereId($value)
 * @method static Builder|ExperienceType whereName($value)
 * @method static Builder|ExperienceType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ExperienceType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ExperienceType withoutTrashed()
 * @mixin Eloquent
 */
class ExperienceType extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
