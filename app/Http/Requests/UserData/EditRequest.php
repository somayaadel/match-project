<?php

namespace App\Http\Requests\UserData;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        dd($this->user_id) ; 
        if($this->user()->id == $this->user_id){
            return true ; 
        }
        else{
            return false ; 
        }
    }

    public function all($keys = NULL){
        // dd('here all') ; 
        $request = Request::all();
        $request['id'] = $this->route('user_data');
        return $request ; 
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:user_data,id' , 
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
        ];
    }
}
