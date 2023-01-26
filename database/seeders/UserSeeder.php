<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('users')->truncate();
        \DB::table('addresses')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        User::factory(50)->create();

        $users_ids     = \DB::table('users')->pluck('id')->toArray();
        $countries_ids = \DB::table('countries')->pluck('id')->toArray();

        foreach ($users_ids as $userId) {
            $country_id = $countries_ids[array_rand($countries_ids)];
            $states_ids = \DB::table('states')->where('country_id', $country_id)->pluck('id')->toArray();

            \DB::table('addresses')->insert([
                [
                    'address_type'     => 'Primary',
                    'address_title'    => 'Primary Address',
                    'country_id'       => $country_id,
                    'state_id'         => $states_ids[array_rand($states_ids)],
                    'addressable_id'   => $userId,
                    'addressable_type' => 'App\Models\User',
                    'created_at'       => Carbon::Now(),
                    'updated_at'       => Carbon::Now()
                ]
            ]);
        }
    }
}
