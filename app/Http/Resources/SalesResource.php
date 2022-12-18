<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "order_no" => $this->order_no,
            "total" => $this->total,
            "order_status" => $this->order_status,
            "created_at" => $this->created_at,
            "contents" => $this->resource['contents']
        ];
    }
}
