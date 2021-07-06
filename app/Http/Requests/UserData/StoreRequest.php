<?php

namespace App\Http\Requests\UserData;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if($this->user()->id == $this->user_id){
            return true ; 
        }
        else{
            return false ; 
        }
    }

    // protected function failedAuthorization()
    // {
    //     return  'fdsa' ; 
    // }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|unique:user_data,user_id' , 
            'summary' => 'string' , 
            'address' => 'string' , 
            'phone' => 'string' , 
            'weight' => 'integer' , 
            'hight' => 'integer' , 
            'birth_date' => 'date' , 
            'gender' => 'string' , 
            'city_id' =>'integer|exists:cities,id',
            'religion_id' =>'integer|exists:religions,id',
            'job_id' =>'integer|exists:jobs,id',
            'application_id' => 'integer|exists:applications,id', 
            'package_id' => 'integer|exists:packages,id', 
        ];
    }


    public function messages()
    {
        return [
            'user_id.unique' => 'this user have profile already',
        ];
    }


}
