<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'brand' => $this->brand,
            'name' => $this->name,
            'sale_price' => $this->sale_price,
            'purchase_price' => $this->purchase_price,
            'quantity' => $this->quantity,
            'model_number' => $this->model_number,
            'mpn' => $this->mpn,
            'description' => $this->description,
            'slug' => $this->slug,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'sale_count' => $this->sale_count,
            'active' => $this->active,
            'allow_inspection' => $this->allow_inspection,
            'store' => [
                'id'         => $this->store->id,
                'owner_id'   => $this->store->owner_id,
                'name'       => $this->store->name,
                'legal_name' => $this->store->legal_name,
                'slug'       => $this->store->slug,
            ],
            'categories' => collect($this->categories)->map(function($cat) {
                return [
                    'id'   => $cat->id,
                    'name' => $cat->name,
                    'slug' => $cat->slug,
                ];
            }),
            'avatar_image' => get_storage_image_url(optional($this->avatarImage)->path, 'avatar'),
        ];
    }
}
