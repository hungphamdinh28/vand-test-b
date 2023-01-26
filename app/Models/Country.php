<?php

namespace App\Models;

class Country extends BaseModel
{
    /**
     * The database table used the model.
     *
     * @var string
     */
    protected $table = 'countries';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'eea' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get all of the states for the country.
     */
    public function states() {
        return $this->hasMany(State::class);
    }

    /**
     * Get the currency for the country.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get all the user for the address.
     */
    public function users()
    {
        return $this->hasManyThrough(User::class, Address::class);
    }
}
