<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends BaseModel
{
    use Imageable, HasFactory;

    /**
     * The database table used by the model.
     *
     * @var array
     */
    protected $table = 'products';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'brand',
        'name',
        'sale_price',
        'purchase_price',
        'quantity',
        'model_number',
        'mpn',
        'description',
        'slug',
        'meta_title',
        'meta_description',
        'sale_count',
        'active',
        'allow_inspection',
    ];

    /**
     * The attributes that should be casted to boolean types.
     *
     * @var array
     */
    protected $cats = ['active', 'allow_inspection'];

    /**
     * Get the store associated with the product.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }

    public function scopeMine($query)
    {
        $user = \Auth::user();
        $store_ids = $user->stores->pluck('id')->toArray();
        return $query->whereIn('store_id', $store_ids);
    }
}
