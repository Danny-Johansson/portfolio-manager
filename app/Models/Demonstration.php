<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Demonstration
 *
 * @property int $id
 * @property string $name
 * @property string $file
 * @property int $demonstration_type_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Tag[] $tags
 * @property-read int|null $tags_count
 * @property-read DemonstrationType $type
 * @method static Builder|Demonstration newModelQuery()
 * @method static Builder|Demonstration newQuery()
 * @method static \Illuminate\Database\Query\Builder|Demonstration onlyTrashed()
 * @method static Builder|Demonstration query()
 * @method static Builder|Demonstration whereCreatedAt($value)
 * @method static Builder|Demonstration whereDeletedAt($value)
 * @method static Builder|Demonstration whereDemonstrationTypeId($value)
 * @method static Builder|Demonstration whereFile($value)
 * @method static Builder|Demonstration whereId($value)
 * @method static Builder|Demonstration whereName($value)
 * @method static Builder|Demonstration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Demonstration withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Demonstration withoutTrashed()
 * @mixin Eloquent
 */
class Demonstration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'file',
        'demonstration_type_id',
    ];

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable','taggables');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(DemonstrationType::class, 'demonstration_type_id');
    }
}
