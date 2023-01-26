<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'id'               => $this->id,
            'owner_id'         => $this->owner_id,
            'name'             => $this->name,
            'legal_name'       => $this->legal_name,
            'slug'             => $this->slug,
            'email'            => $this->email,
            'description'      => $this->description,
            'external_url'     => $this->external_url,
            'active'           => $this->active,
            'phone_verified'   => $this->phone_verified,
            'address_verified' => $this->address_verified,
            'logo_image'       =>  get_storage_image_url(optional($this->logoImage)->path, 'logo')
        ];
    }
}
