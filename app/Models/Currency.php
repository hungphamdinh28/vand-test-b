<?php

namespace App\Models;

class Currency extends BaseModel
{
    /**
     * The database table used the model.
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = [
        'symbol_first'=> 'boolean',
        'active'=> 'boolean',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get all of the countries for the currency.
     */
    public function countries() {
        return $this->hasMany(Countries::class);
    }
}
