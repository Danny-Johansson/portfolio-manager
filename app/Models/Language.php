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
 * App\Models\Language
 *
 * @property int $id
 * @property string $name
 * @property int $speak
 * @property int $read
 * @property int $write
 * @property int $understand
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read LanguageLevel $read_rel
 * @property-read LanguageLevel $speak_rel
 * @property-read LanguageLevel $understand_rel
 * @property-read LanguageLevel $write_rel
 * @method static Builder|Language newModelQuery()
 * @method static Builder|Language newQuery()
 * @method static \Illuminate\Database\Query\Builder|Language onlyTrashed()
 * @method static Builder|Language query()
 * @method static Builder|Language whereCreatedAt($value)
 * @method static Builder|Language whereDeletedAt($value)
 * @method static Builder|Language whereId($value)
 * @method static Builder|Language whereName($value)
 * @method static Builder|Language whereRead($value)
 * @method static Builder|Language whereSpeak($value)
 * @method static Builder|Language whereUnderstand($value)
 * @method static Builder|Language whereUpdatedAt($value)
 * @method static Builder|Language whereWrite($value)
 * @method static \Illuminate\Database\Query\Builder|Language withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Language withoutTrashed()
 * @mixin Eloquent
 */
class Language extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'understand',
        'speak',
        'write',
        'read',
    ];

    public function read_rel(): BelongsTo
    {
        return $this->belongsTo(LanguageLevel::class,'read');
    }

    public function write_rel(): BelongsTo
    {
        return $this->belongsTo(LanguageLevel::class,'write');
    }

    public function speak_rel(): BelongsTo
    {
        return $this->belongsTo(LanguageLevel::class,'speak');
    }

    public function understand_rel(): BelongsTo
    {
        return $this->belongsTo(LanguageLevel::class,'understand');
    }
}
