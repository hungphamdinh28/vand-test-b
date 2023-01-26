<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::table('currencies')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Get all of the currencies.
        $currencies = json_decode(file_get_contents(__DIR__.'/data/currencies.json'), true);

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('currencies')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($currencies as $currency)
        {
            \DB::table('currencies')->insert([
                'iso_code'              => $currency['iso_code'],
                'iso_numeric'           => isset($currency['iso_numeric']) ? $currency['iso_numeric'] : null,
                'name'                  => $currency['name'],
                'symbol'                => isset($currency['symbol']) ? $currency['symbol'] : null,
                'disambiguate_symbol'   => isset($currency['disambiguate_symbol']) ? $currency['disambiguate_symbol'] : null,
                'subunit'               => isset($currency['subunit']) ? $currency['subunit'] : null,
                'subunit_to_unit'       => isset($currency['subunit_to_unit']) ? $currency['subunit_to_unit'] : null,
                'symbol_first'          => isset($currency['symbol_first']) ? $currency['symbol_first'] : 1,
                'html_entity'           => isset($currency['html_entity']) ? $currency['html_entity'] : null,
                'decimal_mark'          => isset($currency['decimal_mark']) ? $currency['decimal_mark'] : null,
                'thousands_separator'   => isset($currency['thousands_separator']) ? $currency['thousands_separator'] : null,
                'smallest_denomination' => isset($currency['smallest_denomination']) ? $currency['smallest_denomination'] : 1,
                'priority'              => isset($currency['priority']) ? $currency['priority'] : 100,
                'active'                => isset($currency['active']) ? $currency['active'] : False,
                'created_at'            => Carbon::Now(),
                'updated_at'            => Carbon::Now()
            ]);
        }
    }
}
