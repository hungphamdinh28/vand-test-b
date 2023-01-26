<?php

namespace App\Services;

use Illuminate\Support\Arr;

class QueryService
{
    public const ASC = 'asc';
    public const DESC = 'desc';
    public const ASCENDING = 'ascending';

    /**
     * Select column owner
     * @var array
     */
    public $select = [];

    /**
     * Column to search using whereLike
     * @var array
     */
    public $columnSearch = [];

    /**
     * Relationship with other tables
     * @var array
     */
    public $withRelationship = [];

    /**
     * Where with other condition
     * @var array
     */
    public $withOrWhere = [];

    /**
     * Paragraph search in column
     * @var ?string
     */
    public $search;

    /**
     * ascending, descending
     * @var ?string
     */
    public $ascending = self::DESC;

    /**
     * Column to order
     * @var string
     */
    public $orderBy = 'created_at';


    /**
     * Column to order
     * @var string
     */
    public $scope = [];

    /**
     * Eloquent model
     * @var Builder|Model $model
     */
    public $builder;

    /**
     * QueryService constructor.
     * @param $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * Query table
     * @return mixed
     */
    public function queryTable()
    {
        $builder = $this->builder;

        if ($this->ascending) {
            $this->ascending = $this->ascending === self::ASC ? self::ASC : self::DESC;
        }

        $builder = $builder->when($this->select, function($q) {
            $q->select($this->select);
        });

        $builder = $builder->when($this->withOrWhere, function ($q) {
            foreach($this->withOrWhere as $where) {
                $idx = count($where) >= 3 ? 2 : 1;
                if (!empty($where[$idx])) {
                    $q->orWhere([$where]);
                }
            }
        });

        $builder = $builder->when($this->search, function($q) {
            foreach (Arr::wrap($this->columnSearch) as $column) {
                $q->orWhere($column, 'LIKE', "%{$this->search}%");
            };
        });

        if (! empty($this->withRelationship)) {
            foreach (Arr::wrap($this->withRelationship) as $relationship) {
                $builder = $builder->with($relationship);
            }
        }

        if (! empty($this->scope)) {
            foreach (Arr::wrap($this->scope) as $scope) {
                $builder = $builder->$scope();
            }
        }

        $builder = $builder->when($this->orderBy && $this->ascending, function($q) {
            $q->orderBy($this->orderBy, $this->ascending);
        });

        return $builder;
    }
}
