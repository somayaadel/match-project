<?php

namespace App\Http\Requests\Auth ;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true ; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = $this ;

        return [
            'application_id' => 'required|exists:applications,id'  , 
            'email' => ['required' ] ,
            'password' => 'required|min:6' , 
        ];
    }


    public function messages()
    {
        return [
        ];
    }

}
