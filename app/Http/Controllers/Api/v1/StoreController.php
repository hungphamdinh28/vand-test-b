<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\CreateStoreRequest;
use App\Http\Resources\Api\v1\StoreResource;
use App\Repositories\Store\StoreRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreController extends Controller
{
    protected $__storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->__storeRepository = $storeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $products = $this->__storeRepository->list($request);

            return $this->jsonTable([
                'data'  => StoreResource::collection($products),
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
    public function store(CreateStoreRequest $request)
    {
        \DB::beginTransaction();
        try {
            $store = $this->__storeRepository->store($request);

            \DB::commit();
            return $this->jsonData(new StoreResource($store), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            \DB::rollback();
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
            $store = $this->__storeRepository->findMine($id);
            if (! empty($store)) {
                return $this->jsonData(new StoreResource($store));
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
    public function update(Request $request, $id)
    {
        \DB::beginTransaction();
        try {
            $store = $this->__storeRepository->update($request, $id);

            \DB::commit();
            return $this->jsonData(new StoreResource($store));
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
            $store = $this->__storeRepository->findMine($id);

            if ($store) {
                $this->__storeRepository->destroy($id);
                return $this->jsonMessage(trans('messages.deleted'));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }
}
