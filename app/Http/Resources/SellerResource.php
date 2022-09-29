<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            "firstname" => $this->firstname,
            "lastname" => $this->lastname,
            "email" => $this->email,
            "phone" => $this->phone,
            //"town" => $this->town,
            //"distance" => isset($this->distance) ? $this->distance : 0,
        ];
    }
}
