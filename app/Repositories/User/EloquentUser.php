<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Illuminate\Http\Request;

class EloquentUser extends EloquentRepository implements BaseRepository, UserRepository
{
    public $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
