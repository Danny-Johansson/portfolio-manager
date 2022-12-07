<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\CertificateIssuer
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|CertificateIssuer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CertificateIssuer newQuery()
 * @method static \Illuminate\Database\Query\Builder|CertificateIssuer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|CertificateIssuer query()
 * @method static \Illuminate\Database\Eloquent\Builder|CertificateIssuer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificateIssuer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificateIssuer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificateIssuer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CertificateIssuer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|CertificateIssuer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|CertificateIssuer withoutTrashed()
 * @mixin \Eloquent
 */
class CertificateIssuer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
