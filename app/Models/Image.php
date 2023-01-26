<?php

namespace App\Models;

class Image extends BaseModel
{
    /**
     * The database table used the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'path',
        'extension',
        'size',
        'order',
        'featured',
        'imageable_id',
        'imageable_type',
    ];

    /**
     * Get all of the owning imageable model.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    /**
     * Setters.
     */
    public function setFeatureAttribute($value)
    {
        $this->attributes['featured'] = (bool) $value ? $value : null;
    }

    public function getUploadedTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getSizeInKbAttribute()
    {
        return $this->size ? round($this->size / 1024, 2) : Null;
    }
}
