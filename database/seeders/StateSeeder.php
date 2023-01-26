<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::table('states')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $files = glob(__DIR__.'/data/states/*.json');

        foreach ($files as $file)
        {
            $country_code = basename($file, '.json');
            $country = \DB::table('countries')->where('iso_code', $country_code)->first();

            $states = json_decode(file_get_contents($file), true);

            foreach ($states as $state) {

                if (! isset($state['iso_code'])) continue;

                \DB::table('states')->insert([
                    'country_id'   => $country->id,
                    'iso_code'     => $state['iso_code'],
                    'iso_numeric'  => isset($state['iso_numeric']) ? $state['iso_numeric'] : null,
                    'name'         => isset($state['name']) ? $state['name'] : null,
                    'calling_code' => isset($state['calling_code']) ? $state['calling_code'] : null,
                    'active'       => isset($state['active']) ? $state['active'] : 1,
                    'created_at'   => Carbon::Now(),
                    'updated_at'   => Carbon::Now()
                ]);
            }
        }
    }
}
