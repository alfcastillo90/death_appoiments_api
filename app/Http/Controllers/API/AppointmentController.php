<?php

namespace App\Http\Controllers\API;

use App\Appointment;
use App\Victim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class AppointmentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appoiments = Appointment::with('victim')->get();
        return response()->json($appoiments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'victim_id' => 'required | numeric',
                'appointed_at' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $daytOfWeek = Carbon::parse($request->appointed_at)->dayOfWeek;
            $hour = Carbon::parse($request->appointed_at)->hour;
            if($daytOfWeek < 1 && $daytOfWeek > 5 && $hour < 9 && $hour > 6){
                throw new \Exception("The schedule must be set for office hours (9 am to 6pm) Monday to Friday)");
            }
            Appointment::create($request->all());
            $success['name'] = Victim::find($request->victim_id)->name;
            return $this->sendResponse($success, 'The appointment was successfully registered.');
        }catch (\Exception $exception){
            return $this->sendError('Error',["message"=>$exception->getMessage(),"line"=>$exception->getLine()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointment = Appointment::find($id);
        return response()->json($appointment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        try{
            $input = $request->all();
            $validator = Validator::make($input,[
                'victim_id' => 'required | numeric',
                'appointed_at' => 'required | unique:appointments'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $appointment = Appointment::findOrFail($appointment->id);
            $appointment->update($request->all());
            $success['name'] = Victim::find($appointment->id)->name;
            return $this->sendResponse($success, 'Appointment successfully updated.');
        }catch (\Exception $exception){
            return $this->sendError('Error',["message"=>$exception->getMessage(),"line"=>$exception->getLine()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        try{
            $appointment = Appointment::findOrFail($id);
            $appointment->delete();
            $success['name'] = Victim::find($id)->name;
            return $this->sendResponse($success, 'Appointment successfully removed.');
        }catch (\Exception $exception){
            return $this->sendError('Error',["message"=>$exception->getMessage(),"line"=>$exception->getLine()]);
        }
    }
}
