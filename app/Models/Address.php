<?php

namespace App\Models;

class Address extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addresses';

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'country:id,name,iso_code',
        'state:id,name,country_id,iso_code'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address_type',
        'address_title',
        'address_line_1',
        'address_line_2',
        'city',
        'state_id',
        'zip_code',
        'country_id',
        'phone',
        'latitude',
        'longitude',
        'addressable_id',
        'addressable_type'
    ];

    /**
     * Get all of the owing addressable models.
     */
    public function addressable()
    {
        return $this->morphTo();
    }

    /**
     * Get the country for the address.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the country for add state.
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
