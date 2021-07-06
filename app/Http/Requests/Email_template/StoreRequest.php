<?php

namespace App\Http\Requests\Email_template ;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $request = $this ;
        return [

            'subject' => ['required',
            'string' ,

            ] ,


        ];
    }


    public function messages()
    {
        return [
        ];
    }

}
