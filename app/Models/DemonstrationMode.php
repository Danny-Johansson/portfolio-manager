<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\DemonstrationMode
 *
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|DemonstrationMode newModelQuery()
 * @method static Builder|DemonstrationMode newQuery()
 * @method static \Illuminate\Database\Query\Builder|DemonstrationMode onlyTrashed()
 * @method static Builder|DemonstrationMode query()
 * @method static Builder|DemonstrationMode whereCreatedAt($value)
 * @method static Builder|DemonstrationMode whereDeletedAt($value)
 * @method static Builder|DemonstrationMode whereId($value)
 * @method static Builder|DemonstrationMode whereName($value)
 * @method static Builder|DemonstrationMode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|DemonstrationMode withTrashed()
 * @method static \Illuminate\Database\Query\Builder|DemonstrationMode withoutTrashed()
 * @mixin Eloquent
 */
class DemonstrationMode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
