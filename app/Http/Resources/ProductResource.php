<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;

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
            "owner" => new UserResource($this->owner),
            "name" => $this->name,
            "brand" => $this->brand,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "description" => $this->description,
            "shipping_cost" => $this->shipping_cost,
            "is_negotiable" => $this->is_negotiable,
            "images" => $this->images->pluck('url'),
            "reviews" => $this->reviews,
            "similar" => Product::without('owner', 'reviews')
            ->where([
                'category_id' => $this->category_id,
                ['brand', 'LIKE', '%'.$this->brand.'%'],
                ['id', '!=', $this->id]
            ])->orWhere([
                'category_id' => $this->category_id,
                ['description', 'LIKE', '%'.$this->description.'%'],
                ['id', '!=', $this->id]
            ])->get()
        ];
    }
}
