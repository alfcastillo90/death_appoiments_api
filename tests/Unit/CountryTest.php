<?php

namespace Tests\Unit;

use App\Country;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
class CountryTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function testGetCountries()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['countries']
        );
        $this->get('/api/countries')->assertOk()->assertJsonFragment(['name' => 'Venezuela']);
    }

    public function testGetCountryById()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['countries']
        );
        $this->get('api/countries/1')->assertOk()->assertJsonFragment(['id'=>1,'name'=>'Venezuela']);
    }

    public function testCreateCountry()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['countries']
        );
        $this->post('api/countries',[
            'name'=>$this->faker->unique()->country
        ])->assertOk()->assertJson(['success'=>true]);
    }

    public function testCreateCountryFailed()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['countries']
        );
        $request = $this->post('api/countries',[
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

    public function testDeleteCountry()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['countries']
        );
        $lastCountry = Country::count();
        $this->delete("api/countries/$lastCountry")->assertOk()->assertJson(['success'=>true]);
    }

    public function testUpdateCountry()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['countries']
        );
        $request = $this->put(route('countries.update',1),[
            'name'=>'Republic of Venezuela'
        ]);
        $request->assertOk()->assertJson(['success'=>true]);
    }
}
