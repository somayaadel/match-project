<?php

namespace App\Http\Requests\Field;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Application ; 

class DestroyRequest extends FormRequest
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
    public function all($keys = NULL){
        $request = Request::all();
        $request['id'] = $this->route('field');
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
            'id' => 'required|integer|exists:fields,id'
        ];
    }


    public function messages()
    {
        return [
            'id.exists'=>"this field id isn't exists" 
        ];
    }

}
