<?php

namespace App\Http\Requests\Application;

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
        return $this->user()->role->name == 'admin' ; 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function all($keys = NULL){
        $request = Request::all();
        $request['id'] = $this->route('application');
        return $request ; 
    }
    
    public function rules()
    {
        return [
            'name' => 'required|string' , 
            'name_ar' => 'required|string' , 
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
