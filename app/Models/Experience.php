<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function type()
    {
        return $this->belongsTo(ExperienceType::class,'experience_type_id');
    }
}
