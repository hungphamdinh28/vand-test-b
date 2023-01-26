<?php

use Database\Seeders\AddressTypeSeeder;
use Database\Seeders\CategoryGroupSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CategorySubGroupSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\CurrencySeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\StoreSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(CurrencySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AddressTypeSeeder::class);
        $this->call(CategoryGroupSeeder::class);
        $this->call(CategorySubGroupSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(ProductSeeder::class);
        $this->command->info('Seeding complete!');
        Model::reguard();
    }
}
