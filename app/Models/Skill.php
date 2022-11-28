<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'skill_level_id'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(SkillLevel::class,'skill_level_id');
    }
}
