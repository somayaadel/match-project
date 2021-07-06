<?php

namespace App\Http\Requests\Feature ;

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
            'name' => 'required|string|unique:features,name' ,
            'service_id' => 'required|integer|exists:services,id' ,
        ];
    }


    public function messages()
    {
        return [
        ];
    }

}
