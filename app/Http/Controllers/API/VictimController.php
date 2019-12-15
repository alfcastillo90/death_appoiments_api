<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateVictimRequest;
use App\Http\Requests\UpdateVictimRequest;
use App\Victim;
use Illuminate\Http\Request;
use Validator;

class VictimController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $victims = Victim::all();
        return response()->json($victims);
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
     * @param  CreateVictimRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVictimRequest $request)
    {
        try{
            $victim = $request->store();
            return $this->sendResponse($victim, 'The victim was successfully registered.');
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
        $victim = Victim::find($id);
        return response()->json($victim);
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
     * @param  UpdateVictimRequest  $request
     * @param  Victim  $victim
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVictimRequest $request, Victim $victim)
    {
        try{

            $victim = $request->update($victim->id);
            return $this->sendResponse($victim, 'Victim successfully updated.');
        }catch (\Exception $exception){
            return $this->sendError('Error',["message"=>$exception->getMessage(),"line"=>$exception->getLine()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $victim = Victim::findOrFail($id);
            $victim->delete();
            $success['name'] = $victim->name;
            return $this->sendResponse($success, 'Victim successfully removed.');
        }catch (\Exception $exception){
            return $this->sendError('Error',["message"=>$exception->getMessage(),"line"=>$exception->getLine()]);
        }
    }
}
