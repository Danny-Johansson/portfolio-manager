<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\SkillLevel
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|SkillLevel newModelQuery()
 * @method static Builder|SkillLevel newQuery()
 * @method static \Illuminate\Database\Query\Builder|SkillLevel onlyTrashed()
 * @method static Builder|SkillLevel query()
 * @method static Builder|SkillLevel whereCreatedAt($value)
 * @method static Builder|SkillLevel whereDeletedAt($value)
 * @method static Builder|SkillLevel whereId($value)
 * @method static Builder|SkillLevel whereName($value)
 * @method static Builder|SkillLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|SkillLevel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|SkillLevel withoutTrashed()
 * @mixin Eloquent
 */
class SkillLevel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

}
