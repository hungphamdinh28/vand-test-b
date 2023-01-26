<?php

namespace App\Repositories\Country;

use App\Models\Country;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCountry extends EloquentRepository implements BaseRepository, CountryRepository
{
    protected $model;

    public function __construct(Country $country)
    {
        $this->model = $country;
    }
}
