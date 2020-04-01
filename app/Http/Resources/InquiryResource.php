<?php

namespace App\Http\Resources;

use App\Inquiry;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Inquiry
 */
class InquiryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'enquirer' => new EnquirerResource($this->enquirer),
            'status' => $this->status,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
