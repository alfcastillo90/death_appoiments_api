<?php

namespace Tests\Unit;

use App\IdentificationType;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class IdentificationTypeTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function testGetIdentificationTypes()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['identification_types']
        );
        $this->get('/api/identification_types')->assertOk()->assertJsonFragment(['name' => 'passport']);
    }

    public function testGetCountryById()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['identification_types']
        );
        $this->get('api/identification_types/1')->assertOk()->assertJsonFragment(['id'=>1,'name'=>'passport']);
    }

    public function testCreateIdentificationType()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['identification_types']
        );
        $this->post('api/identification_types',[
            'name'=>'Driver card'
        ])->assertOk()->assertJson(['success'=>true]);
    }

    public function testCreateIdentificationTypeFailed()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['identification_types']
        );
        $request = $this->post('api/identification_types',[
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

    public function testDeleteIdentificationType()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['identification_types']
        );
        $lastIdentificationType = IdentificationType::count();
        $request = $this->delete("api/identification_types/$lastIdentificationType");
        echo $request->content();
        $request->assertOk()->assertJson(['success'=>true]);
    }

    public function testUpdateIdentificationType()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['identification_types']
        );
        $request = $this->put(route('identification_types.update',1),[
            'name'=>'DNI'
        ]);
        $request->assertOk()->assertJson(['success'=>true]);
    }
}
