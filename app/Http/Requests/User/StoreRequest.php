<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        return $this->user()->role->name == 'admin' ; 
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    

    public function rules()
    {
        return [
            'name' => 'required' , 
            'name_ar' => 'required' , 
            'email' => 'required|unique:users,email'  , 
            'role_id' => 'required|exists:roles,id'   , 
            'application_id' => 'required|exists:applications,id'  , 
            'package_id' => 'exists:packages,id'  , 
            'password' => 'required|min:6|confirmed' , 
            'phone' => 'required|integer' , 
            'birth_date' => 'required|string' , 
            'gender' => 'required|boolean' , 
        ];
    }
}
