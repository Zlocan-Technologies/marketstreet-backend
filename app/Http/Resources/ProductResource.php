<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;

class ProductResource extends JsonResource
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
            "id" => $this->id,
            "owner" => $this->owner,
            "category_id" => $this->category_id,
            "name" => $this->name,
            "brand" => $this->brand,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "description" => $this->description,
            "shipping_cost" => $this->shipping_cost,
            "is_negotiable" => $this->is_negotiable,
            "images" => $this->images->pluck('url'),
            "reviews" => $this->reviews,
            "similar" => Category::find($this->category_id)->products,
        ];
    }
}
