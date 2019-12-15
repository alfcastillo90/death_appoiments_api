<?php

use App\Victim;
use Illuminate\Database\Seeder;

class VictimsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('victims')->truncate();
        Victim::create([
            'name'=>'Fulano',
            'lastname'=>'Sutano',
            'email'=>'fulano.sutano@mengano.comk',
            'identity_number'=>12345678,
            'identification_type_id'=>2,
            'country_of_birth_id'=>1,
            'city_of_residence_id'=>1,
            'address'=>'Fake stret #1234',
            'telephone'=>'+56948666730'
        ]);
        Factory(Victim::class, 10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
