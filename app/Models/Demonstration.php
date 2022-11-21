<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demonstration extends Model
{
    use HasFactory, SoftDeletes;

    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }
}
