<?php

namespace App\Models;

use App\Common\Addressable;
use App\Common\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends BaseModel
{
    use Addressable, Imageable, HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stores';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes casts to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'phone_verified' => 'boolean',
        'address_verified' => 'boolean'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id',
        'name',
        'legal_name',
        'slug',
        'email',
        'description',
        'external_url',
        'active',
        'phone_verified',
        'address_verified',
    ];

    /**
     * Get the user owns the shop.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id')->withTrashed();
    }

    /**
     * Get the address for the shop.
     */
    public function address()
    {
        return $this->hasOne(Address::class, 'addressable');
    }

    /**
     * Get the products for the shop.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeMine($query)
    {
        $user = \Auth::user();
        return $query->where('owner_id', $user->id);
    }
}
