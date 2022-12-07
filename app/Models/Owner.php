<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Owner
 *
 * @property int $id
 * @property string|null $image
 * @property string|null $first_name
 * @property string|null $initials
 * @property string|null $last_name
 * @property string|null $birthday
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $country
 * @property string|null $zip
 * @property string|null $city
 * @property string|null $street_name
 * @property string|null $street_number
 * @property int $license
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder|Owner newModelQuery()
 * @method static Builder|Owner newQuery()
 * @method static Builder|Owner query()
 * @method static Builder|Owner whereBirthday($value)
 * @method static Builder|Owner whereCity($value)
 * @method static Builder|Owner whereCountry($value)
 * @method static Builder|Owner whereCreatedAt($value)
 * @method static Builder|Owner whereEmail($value)
 * @method static Builder|Owner whereFirstName($value)
 * @method static Builder|Owner whereId($value)
 * @method static Builder|Owner whereImage($value)
 * @method static Builder|Owner whereInitials($value)
 * @method static Builder|Owner whereLastName($value)
 * @method static Builder|Owner whereLicense($value)
 * @method static Builder|Owner wherePhone($value)
 * @method static Builder|Owner whereStreetName($value)
 * @method static Builder|Owner whereStreetNumber($value)
 * @method static Builder|Owner whereUpdatedAt($value)
 * @method static Builder|Owner whereZip($value)
 * @mixin Eloquent
 */
class Owner extends Model
{
    use HasFactory;
}
