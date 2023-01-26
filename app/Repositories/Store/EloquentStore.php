<?php

namespace App\Repositories\Store;

use App\Models\Store;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use App\Repositories\Store\StoreRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class EloquentStore extends EloquentRepository implements BaseRepository, StoreRepository
{
    protected $model;

    public function __construct(Store $store)
    {
        $this->model = $store;
    }

    public function list(Request $request)
    {
        $limit     = $request->get('limit', config('constants.pagination.limit'));
        $search    = $request->get('search', '');
        $orderBy   = $request->get('orderBy', '');
        $ascending = $request->get('ascending', '');

        $queryService = new QueryService($this->model);
        $queryService->select  = ['*'];
        $queryService->columnSearch = [
            'name',
            'legal_name',
            'email',
            'external_url',
        ];
        $queryService->search    = $search;
        $queryService->ascending = $ascending;
        $queryService->orderBy   = $orderBy;
        $queryService->scope     = ['mine'];

        $builder = $queryService->queryTable();
        $builder = $builder->paginate($limit);

        return $builder;
    }
}
