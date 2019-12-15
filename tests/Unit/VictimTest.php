<?php

namespace Tests\Unit;

use App\User;
use App\Victim;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class VictimTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function testGetVictims()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['victims']
        );
        $this->get('/api/victims')->assertOk()->assertJsonFragment(['name' => 'Fulano'])->assertJson(array());
    }

    public function testGetVictimById()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['victims']
        );
        $this->get('api/victims/1')->assertOk()->assertJsonFragment(['id'=>1,'name'=>'Fulano']);
    }

    public function testCreateVictim()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['victims']
        );
        $request = $this->post('api/victims',[
            'name'=>$this->faker->name,
            'lastname'=>$this->faker->lastName,
            'email'=>$this->faker->email,
            'identity_number'=>$this->faker->numberBetween(12345678,87654321),
            'identification_type_id'=>$this->faker->numberBetween(1,2),
            'country_of_birth_id'=>1,
            'city_of_residence_id'=>1,
            'address'=>$this->faker->address,
            'telephone'=>$this->faker->phoneNumber
        ]);
        $request->assertOk()->assertJson(['success'=>true,"message"=>"The victim was successfully registered."]);
    }

    public function testCreateVictimFailed()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['victims']
        );
        $request = $this->post('api/victims',[
            'name'=>$this->faker->name,
            'lastname'=>$this->faker->lastName,
            'email'=>$this->faker->email,
            'identity_number'=>$this->faker->numberBetween(12345678,87654321),
            'identification_type_id'=>$this->faker->numberBetween(1,2),
            'country_of_birth_id'=>1,
            'city_of_residence_id'=>1
        ]);
        $request->assertStatus(404);
        $request->assertJson([
            'success'=>false,
            'message'=>'Validation Error.',
            'data'=>[
                'address'=>[
                    "The address field is required."
                ],
                'telephone'=>[
                    "The telephone field is required."
                ]
            ]
        ]);
    }

    public function testDeleteVictim()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['victims']
        );
        $lastVictim = Victim::count();
        $request = $this->delete("api/victims/$lastVictim");
        echo $request->baseResponse->content();
        $request->assertOk()->assertJson(['success'=>true,'message'=>'Victim successfully removed.']);
    }

    public function testUpdateVictim()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['victims']
        );
        $request = $this->put(route('victims.update',1),[
            'name'=>$this->faker->name,
            'lastname'=>$this->faker->lastName,
            'email'=>$this->faker->email,
            'identity_number'=>$this->faker->numberBetween(12345678,87654321),
            'identification_type_id'=>$this->faker->numberBetween(1,2),
            'country_of_birth_id'=>1,
            'city_of_residence_id'=>1,
            'address'=>$this->faker->address,
            'telephone'=>$this->faker->phoneNumber
        ]);
        $request->assertOk()->assertJson(['success'=>true]);
    }
}
