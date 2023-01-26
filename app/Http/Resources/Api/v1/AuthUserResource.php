<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthUserResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'phone'             => $this->phone,
            'active'            => $this->active,
            'dob'               => $this->dob,
            'sex'               => $this->sex,
            'last_visited_at'   => $this->last_visited_at,
            'last_visited_from' => $this->last_visited_from,
            'primary_address'   => $this->primaryAddress ? [
                'id'             => $this->primaryAddress->id,
                'address_type'   => $this->primaryAddress->address_type,
                'address_title'  => $this->primaryAddress->address_title,
                'address_line_1' => $this->primaryAddress->address_line_1,
                'address_line_2' => $this->primaryAddress->address_line_2,
                'country_id'     => $this->primaryAddress->country_id,
                'state_id'       => $this->primaryAddress->state_id,
                'zip_code'       => $this->primaryAddress->zip_code,
                'phone'          => $this->primaryAddress->phone,
                'country'        => $this->primaryAddress->country,
                'state'          => $this->primaryAddress->state,
            ] : null,
        ];
    }
}
