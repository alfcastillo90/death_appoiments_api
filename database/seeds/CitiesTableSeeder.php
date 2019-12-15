<?php

use Illuminate\Database\Seeder;
use App\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('cities')->truncate();
        City::create([
            'country_id'=>1,
            'name'=>'Caracas'
        ]);
        City::create([
            'country_id'=>1,
            'name'=>'Valencia'
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
