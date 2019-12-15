<?php

use App\IdentificationType;
use Illuminate\Database\Seeder;

class IdentificationTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('identification_types')->truncate();
        IdentificationType::create([
            'name'=>'passport'
        ]);
        IdentificationType::create([
            'name'=>'identification card'
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
