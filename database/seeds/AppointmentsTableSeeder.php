<?php

use App\Appointment;
use Illuminate\Database\Seeder;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('appointments')->truncate();
        Appointment::create([
            'victim_id'=>1,
            'appointed_at'=>'2019-12-16 09:00:00'
        ]);
        Appointment::create([
            'victim_id'=>2,
            'appointed_at'=>'2019-12-17 09:00:00'
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
