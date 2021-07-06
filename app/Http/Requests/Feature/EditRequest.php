<?php

namespace App\Http\Requests\Feature;

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
        $request['id'] = $this->route('feature');
        return $request ;
    }

    public function rules()
    {
        return [
            'name' => 'required|string' ,
            'id' => 'required|integer|exists:features,id' ,
            'service_id' => 'required|integer|exists:services,id' ,
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
