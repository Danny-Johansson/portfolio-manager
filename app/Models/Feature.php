<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Feature
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Model|Eloquent $featurable
 * @method static Builder|Feature newModelQuery()
 * @method static Builder|Feature newQuery()
 * @method static \Illuminate\Database\Query\Builder|Feature onlyTrashed()
 * @method static Builder|Feature query()
 * @method static Builder|Feature whereCreatedAt($value)
 * @method static Builder|Feature whereDeletedAt($value)
 * @method static Builder|Feature whereId($value)
 * @method static Builder|Feature whereName($value)
 * @method static Builder|Feature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Feature withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Feature withoutTrashed()
 * @mixin Eloquent
 */
class Feature extends Model
{
    use HasFactory, SoftDeletes;

    public function featurable(): MorphTo
    {
        return $this->morphTo();
    }

}
