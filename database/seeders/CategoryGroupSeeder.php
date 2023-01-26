<?php

namespace Database\Seeders;

use App\Models\CategoryGroup;
use Illuminate\Database\Seeder;

class CategoryGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('category_groups')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        CategoryGroup::factory(50)->create();
    }
}
