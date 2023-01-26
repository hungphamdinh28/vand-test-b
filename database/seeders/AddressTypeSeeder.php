<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('address_types')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('address_types')->insert([
            ['type' => 'Primary'],
            ['type' => 'Billing'],
            ['type' => 'Shipping'],
        ]);
    }
}
