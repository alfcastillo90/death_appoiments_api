<?php

namespace App\Http\Requests;

use App\Victim;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateVictimRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'identity_number'=>'identity number',
            'identification_type_id'=>'identification type',
            'country_of_birth_id'=>'country of birth',
            'city_of_residence_id'=>'city of residence',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'lastname'=>'required',
            'email'=>'required | unique:victims',
            'identity_number'=>'required | unique:victims',
            'identification_type_id'=>'required',
            'country_of_birth_id'=>'required',
            'city_of_residence_id'=>'required',
            'address'=>'required',
            'telephone'=>'required | unique:victims'
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message'=>'Validation Error.',
            'data' => $validator->errors()
        ], 404));
    }

    public function update($id)
    {
        $data = $this->validated();
        $victim = Victim::find($id)->create([
            'name'=>$data['name'],
            'lastname'=>$data['lastname'],
            'email'=>$data['email'],
            'identity_number'=>$data['identity_number'],
            'identification_type_id'=>$data['identification_type_id'],
            'country_of_birth_id'=>$data['country_of_birth_id'],
            'city_of_residence_id'=>$data['city_of_residence_id'],
            'address'=>$data['address'],
            'telephone'=>$data['telephone']
        ]);
        return $victim;
    }
}
