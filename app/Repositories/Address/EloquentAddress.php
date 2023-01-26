<?php

namespace App\Repositories\Address;

use App\Models\Address;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentAddress extends EloquentRepository implements BaseRepository
{
    protected $model;

    public function __construct(Address $address)
    {
        $this->model = $address;
    }
}
