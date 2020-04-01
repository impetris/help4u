<?php

namespace App\Http\Resources;

use App\Person;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Person
 */
class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $additional = [];
        $additional['categories'] = $this->categories->modelKeys();
        $additional['times'] = $this->times->modelKeys();

        return array_merge(
            $data,
            $additional
        );
    }
}
