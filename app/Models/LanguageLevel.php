<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static paginate(mixed $perPage)
 * @method static where(string $string, string $string1, string $string2)
 * @method static create(array $array)
 */
class LanguageLevel extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
      'name'
    ];
}
