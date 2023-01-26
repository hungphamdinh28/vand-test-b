<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends BaseModel
{
    use Imageable, HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_sub_group_id',
        'name',
        'slug',
        'description',
        'active',
        'featured',
        'order',
        'meta_title',
        'meta_description'
    ];

    /**
     * The attributes that should be mutated to dates.
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be casted to boolean types.
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    /**
     * Get the SubGroups for the the category.
     */
    public function subGroup()
    {
        return $this->belongsTo(CategorySubGroup::class, 'category_sub_group_id')->withTrashed();
    }

    /**
     * Get all products for the category
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Setters.
     */
    public function setFeaturedAttribute($value)
    {
        return $this->attributes['featured'] = (bool) $value;
    }

    public function setOrderAttribute($value)
    {
        return $this->attributes['order'] = $value ?: 100;
    }

    /**
     * Scope a query to only include Featured records.
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }
}
