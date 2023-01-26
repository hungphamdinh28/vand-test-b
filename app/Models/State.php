<?php

namespace App\Models;

class State extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    protected $fillable = [
        'country_id'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    /**
     * Get the country for the state.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}