<?php

namespace App\Http\Resources;

use App\Enquirer;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Enquirer
 */
class EnquirerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
