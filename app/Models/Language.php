<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function read_rel()
    {
        return $this->belongsTo(LanguageLevel::class,'read');
    }

    public function write_rel()
    {
        return $this->belongsTo(LanguageLevel::class,'write');
    }

    public function speak_rel()
    {
        return $this->belongsTo(LanguageLevel::class,'speak');
    }

    public function understand_rel()
    {
        return $this->belongsTo(LanguageLevel::class,'understand');
    }
}
