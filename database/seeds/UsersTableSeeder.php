<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        User::create([
            'name'=>'Alfredo',
            'email'=>'cacr1990@gmail.com',
            'password'=>bcrypt(123456)
        ]);
        User::create([
            'name'=>'Mariana',
            'email'=>'mariana.gabriela@gmail.com',
            'password'=>bcrypt(123456)
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
