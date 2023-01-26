<?php
use Illuminate\Support\Str;

if (! function_exists('image_storage_dir'))
{
    function image_storage_dir()
    {
        return config('image.dir');
    }
}

if (! function_exists('image_cache_path'))
{
    function image_cache_path($path = Null)
    {
        $path = config('image.cache_dir') . '/' . $path;

        return Str::finish($path, '/');
    }
}

function get_sender_email($store = null)
{
    if ($store) {
        return $store->email;
    }
    return 'vand.demo@gmail.com';
}

function get_sender_name($store = null)
{
    if ($store) {
        return $store->name;
    }
    return 'vand.demo';
}

if (! function_exists('convert_to_slug_string'))
{
    function convert_to_slug_string($str, $salt = null, $separator = '-')
    {
        if ($salt) {
            return Str::slug($str, $separator) . $separator . Str::slug($salt, $separator);
        }

        return Str::slug($str, $separator);
    }
}

if (! function_exists('get_placeholder_image'))
{
    function get_placeholder_image($size)
    {
        $size = config("image.sizes.{$size}");

        if ($size && is_array($size)) {
            return "https://via.placeholder.com/{$size['w']}x{$size['h']}/eee?fit={$size['fit']}&text=" . 'Vand';
        }

        return url("images/placeholders/no_img.png");
    }
}

if (! function_exists('get_storage_image_url'))
{
    function get_storage_image_url($path, $size = 'default')
    {
        if (empty($path)) {
            return get_placeholder_image($size);
        }

        if (empty($size)) {
            return url($path);
        }

        $size  = config('image.sizes.' . $size);

        return url("{$path}?width={$size['w']}&height={$size['h']}&fit={$size['fit']}");
    }
}
