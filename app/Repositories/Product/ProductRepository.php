<?php

namespace App\Repositories\Product;

use Illuminate\Http\Request;

interface ProductRepository {
    public function list(Request $request);
}
