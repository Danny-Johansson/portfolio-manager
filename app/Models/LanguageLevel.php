<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\LanguageLevel
 *
 * @method static paginate(mixed $perPage)
 * @method static where(string $string, string $string1, string $string2)
 * @method static create(array $array)
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|LanguageLevel newModelQuery()
 * @method static Builder|LanguageLevel newQuery()
 * @method static \Illuminate\Database\Query\Builder|LanguageLevel onlyTrashed()
 * @method static Builder|LanguageLevel query()
 * @method static Builder|LanguageLevel whereCreatedAt($value)
 * @method static Builder|LanguageLevel whereDeletedAt($value)
 * @method static Builder|LanguageLevel whereId($value)
 * @method static Builder|LanguageLevel whereName($value)
 * @method static Builder|LanguageLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LanguageLevel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LanguageLevel withoutTrashed()
 * @mixin Eloquent
 */
class LanguageLevel extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
      'name'
    ];
}
