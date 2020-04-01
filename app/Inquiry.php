<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Inquiry
 *
 * @property int $id
 * @property int $enquirer_id
 * @property int $person_id
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Inquiry onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry whereEnquirerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry wherePersonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Inquiry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Inquiry withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Inquiry withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Enquirer $enquirer
 */
class Inquiry extends Model
{
    use SoftDeletes;

    protected $fillable
        = [
            'status',
            'person_id',
            'enquirer_id',
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enquirer()
    {
        return $this->belongsTo(Enquirer::class);
    }
}
