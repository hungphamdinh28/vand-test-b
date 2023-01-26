<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        //  CATALOG
        $this->app->singleton(
            \App\Repositories\CategoryGroup\CategoryGroupRepository::class,
            \App\Repositories\CategoryGroup\EloquentCategoryGroup::class
        );

        $this->app->singleton(
            \App\Repositories\CategorySubGroup\CategorySubGroupRepository::class,
            \App\Repositories\CategorySubGroup\EloquentCategorySubGroup::class
        );

        $this->app->singleton(
            \App\Repositories\Category\CategoryRepository::class,
            \App\Repositories\Category\EloquentCategory::class
        );

        $this->app->singleton(
            \App\Repositories\Product\ProductRepository::class,
            \App\Repositories\Product\EloquentProduct::class
        );

        // ADMIN
        $this->app->singleton(
            \App\Repositories\User\UserRepository::class,
            \App\Repositories\User\EloquentUser::class
        );

        // COMMON
        $this->app->singleton(
            \App\Repositories\Address\AddressRepository::class,
            \App\Repositories\Address\EloquentAddress::class
        );

        $this->app->singleton(
            \App\Repositories\Country\CountryRepository::class,
            \App\Repositories\Country\EloquentCountry::class
        );

        // VENDORS
        $this->app->singleton(
            \App\Repositories\Store\StoreRepository::class,
            \App\Repositories\Store\EloquentStore::class
        );
    }
}
