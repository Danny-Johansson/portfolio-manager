<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function issuer()
    {
        return $this->belongsTo(CertificateIssuer::class,'certificate_issuer_id');
    }
}
