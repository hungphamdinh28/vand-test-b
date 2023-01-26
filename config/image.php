<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */
    'dir' => [
        'default'              => 'images',
        'category_groups'     => 'uploads/category_groups',
        'category_sub_groups' => 'uploads/category_sub_groups',
        'categories'          => 'uploads/categories',
        'products'            => 'uploads/products',
        'stores'              => 'uploads/stores',
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache dir
    |--------------------------------------------------------------------------
    |
    | Name the directory on the storage where all the manipulated cache images will be saved
    | Dont change this if you're not sure
    |
    */
    'cache_dir' => '.cache',

    /*
    |--------------------------------------------------------------------------
    | Minimum Image size
    |--------------------------------------------------------------------------
    |
    | Specify the minimum size of image can be uploaded
    | The size is Kilobyte or KB, Default = 5000KB = ~5MB
    |
    */
    'min_size' => 0,

     /*
    |--------------------------------------------------------------------------
    | Maximum Image size
    |--------------------------------------------------------------------------
    |
    | Specify the maximum size of image can be uploaded
    | The size is Kilobyte or KB, Default = 5000KB = ~5MB
    |
    */
    'max_size' => 1024,

    /*
    |--------------------------------------------------------------------------
    | Chunk size in KB
    |--------------------------------------------------------------------------
    |
    | Specify the chunk size for large image can be uploaded
    | The size is Kilobyte or KB, Default = 500KB
    |
    */
    'chunk_size' => 1024,

    /*
    |--------------------------------------------------------------------------
    | Mime types
    |--------------------------------------------------------------------------
    |
    | Specify the mime types of image can be uploaded
    |
    */
    'mime_types' => [
        'jpeg','jpg','png','gif'
    ],

    /*
    |--------------------------------------------------------------------------
    | Image sizes
    |--------------------------------------------------------------------------
    |
    | When you upload any image. It'll create some thumbnails to view different places in the app
    | reason, this will improve the UX and reduce the load time
    |
    */
    'sizes' => [
        /*
        |--------------------------------------------------------------------------
        | Primary sizes
        |--------------------------------------------------------------------------
        |
        | The system will create thumbnails using these settings only.
        | Any request for other than this sizes will return the original image.
        | Sets how the image is fitted to its target dimensions.
        |
        | w = width, h = height. All values are in pixels
        |
        | fit = how the image is fitted to its target dimensions,
        | Available values "contain,max,fill,stretch,crop"
        |
        | Don't modify this values if you are not sure
        |
        */
        'default' => [
            'w' => 250,
            'h' => 400,
            'fit' => 'contain'
        ],
        /*
        |--------------------------------------------------------------------------
        | Logo and background sizes
        |--------------------------------------------------------------------------
        |
        | The system will create a logo image using this size
        | Don't modify this values if you are not sure
        |
        */
        'logo' => [
            'w' => 60,
            'h' => 60,
            'fit' => 'contain'
        ],
        'logo_lg' => [
            'w' => 110,
            'h' => 110,
            'fit' => 'contain'
        ],
        'background' => [
            'w' => 250,
            'h' => 250,
            'fit' => 'contain'
        ],
        /*
        |--------------------------------------------------------------------------
        | Full with banner/cover size
        |--------------------------------------------------------------------------
        |
        | The system will create a banner image using this size
        | Don't modify this values if you are not sure
        |
        */
        'cover' => [
            'w' => 1280,
            'h' => 300,
            'fit' => 'contain'
        ],
        'cover_thumb' => [
            'w' => 150,
            'h' => 59,
            'fit' => 'contain'
        ],
        'blog' => [
            'w' => 1280,
            'h' => 450,
            'fit' => 'crop'
        ],
        'favicon' => [
            'w' => 50,
            'h' => 50,
            'fit' => 'crop'
        ],
        'banner' => [
            'w' => 1425,
            'h' => 436,
            'fit' => 'crop'
        ],
        'avatar' => [
            'w' => 495,
            'h' => 495,
            'fit' => 'contain'
        ],
    ]
];
