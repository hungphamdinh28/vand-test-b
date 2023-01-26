<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use App\Services\QueryService;
use Illuminate\Http\Request;

class EloquentProduct extends EloquentRepository implements BaseRepository, ProductRepository
{
    public $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function list(Request $request)
    {
        $limit     = $request->get('limit', config('constants.pagination.limit'));
        $search    = $request->get('search', '');
        $orderBy   = $request->get('orderBy', '');
        $ascending = $request->get('ascending', '');

        // \DB::statement("SET SESSION sql_mode = ''");
        \DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
        $builder = $this->model->with(['categories', 'store'])
                ->leftJoin('category_product', 'category_product.product_id', '=', 'products.id')
                ->leftJoin('categories', 'categories.id', '=', 'category_product.category_id')
                ->leftJoin('stores', 'stores.id', '=', 'products.store_id')
                ->select('products.*')
                ->groupBy('products.id');

        $queryService = new QueryService($builder);
        $queryService->select  = ['products.*'];
        $queryService->columnSearch = [
            'products.name',
            'products.brand',
            'products.model_number',
            'products.mpn',
            'categories.name',
            'stores.name',
            'stores.legal_name',
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
