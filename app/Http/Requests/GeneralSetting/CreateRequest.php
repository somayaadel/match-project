<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateRequest extends FormRequest
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


    public function rules()
    {
        return [
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
