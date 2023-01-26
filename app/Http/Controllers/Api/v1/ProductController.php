<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\CreateProductRequest;
use App\Http\Requests\Api\v1\UpdateProductRequest;
use App\Http\Resources\Api\v1\ProductResource;
use App\Repositories\Product\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $__productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->__productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $products = $this->__productRepository->list($request);

            return $this->jsonTable([
                'data'  => ProductResource::collection($products),
                'total' => ($products->toArray())['total']
            ]);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        \DB::beginTransaction();
        try {
            $store = $this->__productRepository->store($request);

            \DB::commit();
            return $this->jsonData(new ProductResource($store), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            \DB::rollBack();
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = $this->__productRepository->findMine($id);
            if (! empty($product)) {
                return $this->jsonData(new ProductResource($product));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $product = $this->__productRepository->update($request, $id);

            \DB::commit();
            return $this->jsonData(new ProductResource($product));
        } catch (\Exception $e) {
            \DB::rollback();
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = $this->__productRepository->findMine($id);

            if ($product) {
                $this->__productRepository->destroy($id);
                return $this->jsonMessage(trans('messages.deleted'));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }
}
