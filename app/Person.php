<?php

namespace App;

use App\Traits\SaveQuietly;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\Geocoder\Facades\Geocoder;

/**
 * App\Person
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $zip
 * @property string $place
 * @property string $phone
 * @property float $lat
 * @property float $long
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereZip($value)
 * @mixin \Eloquent
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Time[] $times
 * @property-read int|null $times_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person sortByDistance($address = '')
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Inquiry[] $inquiries
 * @property-read int|null $inquiries_count
 * @property float|null $latitude
 * @property float|null $longitude
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Person whereLongitude($value)
 */
class Person extends Model
{

    use SaveQuietly;

    protected $fillable = [
        'last_name',
        'first_name',
        'address',
        'zip',
        'place',
        'phone',
    ];

    protected $casts = [
        'lat' => 'float',
        'long' => 'float',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function times()
    {
        return $this->belongsToMany(Time::class);
    }

    public function getNameAttribute()
    {
        return $this->attributes['last_name'] . ' ' . $this->attributes['first_name'];
    }

    /**
     * @param  string|null  $phone
     */
    public function setPhoneAttribute(string $phone = null): void
    {
        if ($phone) {
            try {
                $this->attributes['phone'] = PhoneNumber::make($phone, ['AUTO', 'CH'])->formatE164();
            } catch (\Exception $exception) {
                $this->attributes['phone'] = $phone;
            }
        }
    }

    /**
     * @param  Builder  $query
     * @param  string  $address
     *
     * @return Builder
     */
    public function scopeSortByDistance(Builder $query, Model $person)
    {
        return $query->selectRaw('(3959 * acos(cos(radians(?))
                     * cos(radians(latitude))
                     * cos(radians(longitude)
                     - radians(?))
                     + sin(radians(?))
                     * sin(radians(latitude)))
               ) AS distance',
            [
                $person->lat,
                $person->long,
                $person->lat
            ])->orderBy('distance', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}
