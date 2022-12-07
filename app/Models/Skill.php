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
 * App\Models\Skill
 *
 * @property int $id
 * @property string $name
 * @property int $skill_level_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read SkillLevel $level
 * @method static Builder|Skill newModelQuery()
 * @method static Builder|Skill newQuery()
 * @method static \Illuminate\Database\Query\Builder|Skill onlyTrashed()
 * @method static Builder|Skill query()
 * @method static Builder|Skill whereCreatedAt($value)
 * @method static Builder|Skill whereDeletedAt($value)
 * @method static Builder|Skill whereId($value)
 * @method static Builder|Skill whereName($value)
 * @method static Builder|Skill whereSkillLevelId($value)
 * @method static Builder|Skill whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Skill withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Skill withoutTrashed()
 * @mixin Eloquent
 */
class Skill extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'skill_level_id'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(SkillLevel::class,'skill_level_id');
    }
}
