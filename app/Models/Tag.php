<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'tag_category_id',
        'text_color',
        'background_color',
        'border_color',
    ];
    public function taggable()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->belongsTo(TagCategory::class,'tag_category_id');
    }
}
