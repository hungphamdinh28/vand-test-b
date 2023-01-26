<?php

namespace App\Repositories\State;

use App\Models\State;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentState extends EloquentRepository implements BaseRepository, StateRepository
{
    protected $model;

    public function __construct(State $state)
    {
        $this->model = $state;
    }
}