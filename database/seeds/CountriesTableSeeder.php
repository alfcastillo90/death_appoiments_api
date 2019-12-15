<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('countries')->truncate();
        Country::create([
            'name'=>'Venezuela'
        ]);
        Country::create([
            'name'=>'Chile'
        ]);
        Factory(Country::class, 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
