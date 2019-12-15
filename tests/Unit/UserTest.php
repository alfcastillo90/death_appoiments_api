<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testRegisterSuccess()
    {
        $request = $this->post('api/register', [
            "name" => "Alfredo Rodriguez",
            "email" => "alfredoa@gmail.com",
            "password" => 123456,
            "c_password" => 123456
        ]);
        $request->assertOk();
        $request->assertJson(["success"=>true]);
    }

    public function testLoginSuccess()
    {
        $request = $this->post('api/login', [
            "email" => "Milagros1@gmail.com",
            "password" => 123456
        ]);
        $request->assertOk();
        $request->assertJson(["success"=>true]);
    }

}
