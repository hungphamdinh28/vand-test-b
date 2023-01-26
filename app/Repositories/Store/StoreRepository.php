<?php

namespace App\Repositories\Store;

use Illuminate\Http\Request;

interface StoreRepository
{
    public function list(Request $request);
};
