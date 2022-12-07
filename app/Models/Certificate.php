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
 * App\Models\Certificate
 *
 * @property int $id
 * @property string $name
 * @property string|null $earn_date
 * @property string|null $expire_date
 * @property string|null $note
 * @property string $file
 * @property int $certificate_issuer_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read CertificateIssuer $issuer
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate newQuery()
 * @method static Builder|Certificate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereCertificateIssuerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereEarnDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereExpireDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Certificate whereUpdatedAt($value)
 * @method static Builder|Certificate withTrashed()
 * @method static Builder|Certificate withoutTrashed()
 * @mixin Eloquent
 */
class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'earn_date',
        'expire_date',
        'note',
        'file',
        'certificate_issuer_id',
    ];

    public function issuer(): BelongsTo
    {
        return $this->belongsTo(CertificateIssuer::class,'certificate_issuer_id');
    }
}
