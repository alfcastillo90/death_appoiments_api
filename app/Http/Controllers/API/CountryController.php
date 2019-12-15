<?php

namespace App\Http\Controllers\API;

use App\Country;
use Illuminate\Http\Request;
use Validator;

class CountryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        return response()->json($countries);
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
            $country = Country::create($request->all());
            $success['name'] =  $country->name;
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
        $country = Country::find($id);
        return response()->json($country);
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
    public function update(Request $request, Country $country)
    {
        try{
            $input = $request->all();
            $validator = Validator::make($input,[
                'name' => 'required'
            ]);
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $country = Country::findOrFail($country->id);
            $country->update($request->all());
            $success['name'] = $country->name;
            return $this->sendResponse($success, 'Country successfully updated.');
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
        $country = Country::find($id);
        $country->delete();
        $success['name'] = $country->name;
        return $this->sendResponse($success, 'Country successfully removed.');
    }
}
