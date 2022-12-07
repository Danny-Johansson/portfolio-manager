<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\Experience
 *
 * @property int $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property string $location
 * @property string|null $note
 * @property int $experience_type_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read ExperienceType $type
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newQuery()
 * @method static Builder|Experience onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience query()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereExperienceTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereUpdatedAt($value)
 * @method static Builder|Experience withTrashed()
 * @method static Builder|Experience withoutTrashed()
 * @mixin Eloquent
 */
class Experience extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'location',
        'experience_type_id',
        'start_date',
        'end_date',
        'note'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ExperienceType::class,'experience_type_id');
    }
}
