<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Time
 *
 * @property int $id
 * @property string $time
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Time whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Time extends Model
{
    //
}
