<?php

namespace App\Models;

use App\Common\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategorySubGroup extends BaseModel
{
    use Imageable, HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category_sub_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'category_group_id', 'slug', 'description', 'active', 'order', 'meta_title', 'meta_description'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Cascade Soft Deletes Relationships
     *
     * @var array
     */
    protected $cascadeDeletes = ['categories'];

    /**
     * Get the categoryGroup that owns the SubGroup.
     */
    public function group()
    {
        return $this->belongsTo(CategoryGroup::class, 'category_group_id')->withTrashed();
    }

    /**
     * Get the categories for the CategorySubGroup.
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'category_sub_group_id')->orderBy('order', 'asc');
    }

    /**
     * Setters
     */
    public function setOrderAttribute($value)
    {
        $this->attributes['order'] = $value ?: 100;
    }
}
