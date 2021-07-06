<?php

namespace App\Http\Requests\Earning;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class IndexRequest extends FormRequest
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
        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
