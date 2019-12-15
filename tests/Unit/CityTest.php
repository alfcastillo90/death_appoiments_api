<?php

namespace Tests\Unit;

use App\City;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CityTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function testGetCities()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['cities']
        );
        $this->get('/api/cities')->assertOk()->assertJsonFragment(['name' => 'Caracas']);
    }

    public function testGetCityById()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['cities']
        );
        $this->get('api/cities/1')->assertOk()->assertJsonFragment(['id'=>1,'name'=>'Caracas']);
    }

    public function testCreateCity()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['cities']
        );
        $this->post('api/cities',[
            'country_id'=>1,
            'name'=>'Merida'
        ])->assertOk()->assertJson(['success'=>true]);
    }

    public function testCreateCityFailed()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['cities']
        );
        $request = $this->post('api/cities',[
            'country_id'=>1,
            'name'=>null
        ]);
        $request->assertStatus(404);
        $request->assertJson([
            'success'=>false,
            'message'=>'Validation Error.',
            'data'=>[
                'name'=>[
                    "The name field is required."
                ]
            ]
        ]);
    }

    public function testDeleteCity()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['cities']
        );
        $lastCity = City::count();
        $this->delete("api/cities/$lastCity")->assertOk()->assertJson(['success'=>true]);
    }

    public function testUpdateCity()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['cities']
        );
        $request = $this->put(route('cities.update',1),[
            'name'=>'Santiago de Leon de Caracas'
        ]);
        $request->assertOk()->assertJson(['success'=>true]);
    }
}
