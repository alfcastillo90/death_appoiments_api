<?php

namespace Tests\Unit;

use App\Appointment;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function testGetAppointments()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['appointments']
        );
        $this->get('/api/appointments')->assertOk()->assertJson(
           [
               ['id' => 1,'victim_id'=>1,'appointed_at'=>'2019-12-16 09:00:00'],
               ['id' => 2,'victim_id'=>2,'appointed_at'=>'2019-12-17 09:00:00']
           ]
        );
    }

    public function testGetAppointmentById()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['appointments']
        );
        $this->get('api/appointments/1')->assertOk()->assertJson(['id' => 1,'victim_id'=>1,'appointed_at'=>'2019-12-16 09:00:00']);
    }

    public function testCreateAppointment()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['appointments']
        );
        $request = $this->post('api/appointments',[
            'victim_id'=>3,
            'appointed_at'=>'2019-12-20 10:00:00'
        ]);
        $request->assertOk()->assertJson(['success'=>true,'message'=>'The appointment was successfully registered.']);
    }

    public function testCreateAppointmentFailed()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['appointments']
        );
        $request = $this->post('api/appointments',[
            'appointed_at'=>null
        ]);
        $request->assertStatus(404);
        $request->assertJson([
            'success'=>false,
            'message'=>'Validation Error.',
            'data'=>[
                'victim_id'=>[
                    "The victim id field is required."
                ],
                'appointed_at'=>[
                    "The appointed at field is required."
                ]
            ]
        ]);
    }

    public function testDeleteAppointment()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['appointments']
        );
        $lastAppointment = Appointment::count();
        $this->delete("api/appointments/$lastAppointment")->assertOk()->assertJson(['success'=>true]);
    }

    public function testUpdateAppointment()
    {
        $user = User::first();
        Passport::actingAs(
            $user,
            ['appointments']
        );
        $request = $this->put(route('appointments.update',1),[
            'victim_id'=>3,
            'appointed_at'=>'2019-12-19 10:00:00'
        ]);
        $request->assertOk()->assertJson(['success'=>true]);
    }
}
