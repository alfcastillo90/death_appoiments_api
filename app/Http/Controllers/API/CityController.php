<?php

namespace App\Http\Controllers\API;

use App\City;
use Illuminate\Http\Request;
use Validator;

class CityController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return response()->json($cities);
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
            $city = City::create($request->all());
            $success['name'] =  $city->name;
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
        $city = City::find($id);
        return response()->json($city);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        try{
            $input = $request->all();
            $validator = Validator::make($input,[
                'name' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $city = City::findOrFail($city->id);
            $city->update($request->all());
            $success['name'] = $city->name;
            return $this->sendResponse($success, 'City successfully updated.');
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
        $city = City::find($id);
        $city->delete();
        $success['name'] = $city->name;
        return $this->sendResponse($success, 'City successfully removed.');
    }
}
