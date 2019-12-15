<?php

namespace App\Http\Controllers\API;

use App\IdentificationType;
use Illuminate\Http\Request;
use Validator;

class IdentificationTypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $identificationTypes = IdentificationType::all();
        return response()->json($identificationTypes);
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
                'name' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $identificationType = IdentificationType::create($request->all());
            $success['name'] =  $identificationType->name;
            return $this->sendResponse($success, 'The country was successfully registered.');
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
        $identificationType = IdentificationType::find($id);
        return response()->json($identificationType);
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
     * @param  IdentificationType  $identificationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IdentificationType $identificationType)
    {
        try{
            $input = $request->all();
            $validator = Validator::make($input,[
                'name' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $identificationType = IdentificationType::findOrFail($identificationType->id);
            $identificationType->update($request->all());
            $success['name'] = $identificationType->name;
            return $this->sendResponse($success, 'IdentificationType successfully updated.');
        }catch (\Exception $exception){
            return $this->sendError('Error',["message"=>$exception->getMessage(),"line"=>$exception->getLine()]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $identificationType = IdentificationType::find($id);
        $identificationType->delete();
        $success['name'] = $identificationType->name;
        return $this->sendResponse($success, 'IdentificationType successfully removed.');
    }
}
