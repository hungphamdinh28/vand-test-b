<?php

namespace App\Repositories\CategorySubGroup;

use App\Models\CategorySubGroup;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentCategorySubGroup extends EloquentRepository implements BaseRepository, CategorySubGroupRepository
{
    protected $model;

    public function __construct(CategorySubGroup $categorySubGroup)
    {
        $this->model = $categorySubGroup;
    }
}
