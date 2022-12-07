<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Jobsearch
 *
 * @property int $id
 * @property string $company
 * @property string|null $address
 * @property string|null $article
 * @property string|null $website
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $person
 * @property string|null $apply_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 * @property-read JobsearchStatus|null $status
 * @property-read JobsearchType|null $type
 * @method static Builder|Jobsearch newModelQuery()
 * @method static Builder|Jobsearch newQuery()
 * @method static \Illuminate\Database\Query\Builder|Jobsearch onlyTrashed()
 * @method static Builder|Jobsearch query()
 * @method static Builder|Jobsearch whereAddress($value)
 * @method static Builder|Jobsearch whereApplyDate($value)
 * @method static Builder|Jobsearch whereArticle($value)
 * @method static Builder|Jobsearch whereCompany($value)
 * @method static Builder|Jobsearch whereCreatedAt($value)
 * @method static Builder|Jobsearch whereDeletedAt($value)
 * @method static Builder|Jobsearch whereEmail($value)
 * @method static Builder|Jobsearch whereId($value)
 * @method static Builder|Jobsearch wherePerson($value)
 * @method static Builder|Jobsearch wherePhone($value)
 * @method static Builder|Jobsearch whereUpdatedAt($value)
 * @method static Builder|Jobsearch whereWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|Jobsearch withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Jobsearch withoutTrashed()
 * @mixin Eloquent
 */
class Jobsearch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company',
        'title',
        'address',
        'article',
        'website',
        'email',
        'phone',
        'person',
        'apply_date',
        'jobsearch_type_id',
        'jobsearch_status_id'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(JobsearchType::class,'jobsearch_type_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(JobsearchStatus::class,'jobsearch_status_id');
    }
}
