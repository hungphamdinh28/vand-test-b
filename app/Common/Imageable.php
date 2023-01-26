<?php

namespace App\Common;

trait Imageable
{
    private $_publicPath  = 'public';
    private $_storagePath = 'app/public';

	/**
	 * Check if model has an images.
	 *
	 * @return bool
	 */
	public function hasImages()
	{
		return (bool) $this->images()->count();
	}

	/**
	 * Return collection of images related to the imageable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function images()
    {
        return $this->morphMany(\App\Models\Image::class, 'imageable')
        ->where(function($q){
        	$q->whereNull('featured')->orWhere('featured', 0);
        })->orderBy('order', 'asc');
    }

	/**
	 * Return the image related to the imageable
	 *
	 * @return Illuminate\Database\Eloquent\Collection
	 */
	public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->orderBy('order', 'asc');
    }

    /**
     *
     */
    public function saveImage($image, $dir, $type = null)
    {
        $disk  = \Storage::disk();
        $size  = config('image.sizes.' . $type);
        $size  = $size ? $size : config('image.sizes.default');

        $imageAnalysis    = $this->analysisImage($image);
        $imageName        = $imageAnalysis->getImageName();
        $imageExtension   = $imageAnalysis->getImageExtension();
        $imagePathToStore = $imageAnalysis->getImagePathToStore();
        $saveFolder       = $this->_publicPath . '/' . $dir;

        if ($this->_checkImageExists("{$saveFolder}/{$imagePathToStore}")) {
            $imagePathToStore =  $imageName . '-' . md5(time()) . '.' . $imageExtension;
        }

        $path   = $image->storeAs($saveFolder, $imagePathToStore);
        $source = storage_path("{$this->_storagePath}/{$dir}/{$imagePathToStore}");
        $target = public_path("{$dir}/{$imagePathToStore}");

        \Image::make($source)->resize($size['w'], $size['h'], function($constraint) {
            $constraint->aspectRatio();
        })->save($target);

        return $this->_createImage($disk->url($path), $imageName, $imageExtension, $imageAnalysis->getImageSize(), $type);
    }

    private function _createImage($path, $name, $ext = '.jpeg', $size = null, $type = null)
    {
        return $this->image()->create([
            'name'      => $name,
            'path'      => $path,
            'extension' => $ext,
            'size'      => $size,
            'type'      => $type,
        ]);
    }

    public function analysisImage($image)
    {
        return new class($image)
        {
            private $image;

            public function __construct($image)
            {
                $this->image = $image;
            }

            public function getImageName()
            {
                return \Str::slug(pathinfo($this->image->getClientOriginalName(), PATHINFO_FILENAME));
            }

            public function getImageExtension()
            {
                return $this->image->getClientOriginalExtension();
            }

            public function getImageSize()
            {
                return $this->image->getSize();
            }

            public function getImagePathToStore($prefix = '')
            {
                return $prefix . $this->getImageName() . '.' . $this->getImageExtension();
            }
        };
    }

    private function _checkImageExists($imagePath)
    {
        $disk     = \Storage::disk();
        $imageURL = parse_url($imagePath, PHP_URL_PATH);
        return !!$disk->exists($imageURL);
    }

    public function avatarImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'avatar');
    }

    public function backgroundImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'background');
    }

    public function coverImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'cover');
    }

    public function logoImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'logo');
    }

    public function faviconImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'favicon');
    }

    public function bannerImage()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable')->where('type', 'banner');
    }

    public function deleteImageTypeOf($type)
    {
        if ($type) {
            $rel = $type . 'Image';
            if ($image = $this->$rel) {
                $this->deleteImage($image);
            }
        }
    }

    public function deleteImage($image = null)
    {
        if (! $image) {
            $image = $this->image;
        }

        if (optional($image)->path) {
            $disk = \Storage::disk();
            $disk->delete($image->path);
            return $image->delete();
        }

        return;
    }

    public function updateImage($image, $dir, $type = null)
    {
        $this->deleteImageTypeOf($type);

        return $this->saveImage($image, $dir, $type);
    }
}
