<?php

namespace App;

use App\Traits\SaveQuietly;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;

/**
 * App\Enquirer
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $zip
 * @property string $place
 * @property string $phone
 * @property float|null $lat
 * @property float|null $long
 * @property int $category_id
 * @property int $time_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereTimeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereZip($value)
 * @mixin \Eloquent
 * @property float|null $latitude
 * @property float|null $longitude
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereLongitude($value)
 * @property string|null $email
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enquirer whereEmail($value)
 */
class Enquirer extends Model
{

    use SaveQuietly;

    protected $fillable
        = [
            'time_id',
            'category_id',
            'first_name',
            'last_name',
            'address',
            'zip',
            'place',
            'phone',
            'email',
        ];

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
}
