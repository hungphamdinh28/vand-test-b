<?php

namespace App\Common;

trait Addressable
{
    /**
     * Check if model has an address.
     *
     * @return bool
     */
    public function hasAddress()
    {
        return (bool) $this->addresses()->count();
    }

    /**
     * Return any address related to the model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function address()
    {
        return $this->addresses->first();
    }

    /**
     * Return collection of addresses related to the tagged model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function addresses()
    {
        return $this->morphMany(\App\Models\Address::class, 'addressable');
    }

    /**
     * Fetch primary address
     *
     * @return Address|null
     */
    public function primaryAddress()
    {
        return $this->morphOne(\App\Models\Address::class, 'addressable')->where('address_type', 'Primary');
    }

    /**
     * Fetch billing address
     *
     * @return Address|null
     */
    public function billingAddress()
    {
        return $this->morphOne(\App\Models\Address::class, 'addressable')->where('address_type', 'Billing');
    }

    /**
     * Fetch shipping address
     *
     * @return Address|null
     */
    public function shippingAddress()
    {
        return $this->morphOne(\App\Models\Address::class, 'addressable')->where('address_type', 'Shipping');
    }

    /**
     * Deletes all the addresses of this model.
     *
     * @return bool
     */
    public function flushAddresses() : bool
    {
        return $this->addresses()->delete();
    }
}
