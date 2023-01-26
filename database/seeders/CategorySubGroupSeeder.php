<?php

namespace Database\Seeders;

use App\Models\CategorySubGroup;
use Illuminate\Database\Seeder;

class CategorySubGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('category_sub_groups')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        CategorySubGroup::factory(50)->create();
    }
}
