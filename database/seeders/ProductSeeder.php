<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('products')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Product::factory(50)->create();

        Product::all()->each(function($product) {
            $categories = Category::all()->random(5)->pluck('id')->toArray();
            $product->categories()->sync($categories);
        });
    }
}
