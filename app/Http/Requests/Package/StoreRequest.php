<?php

namespace App\Http\Requests\Package ;

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

            'name' => ['required',
            'string' ,
            Rule::unique('packages')->where(function ($query) use ($request) {
                return $query
                    ->where('name' , $request->name)
                    ->where('application_id' , $request->application_id) ;
                    // ->whereNotIn('id', [$request->id]);
            })
            ],   
            'name_ar' => ['required',
            'string' ,
            Rule::unique('packages')->where(function ($query) use ($request) {
                return $query
                    ->where('name_ar' , $request->name_ar)
                    ->where('application_id' , $request->application_id) ;
                    // ->whereNotIn('id', [$request->id]);
            })
            ],
            'application_id' => 'required|integer|exists:applications,id',
            'duration' => 'required|integer' ,
            'role_id' => 'required|integer|exists:roles,id' , 
            'price' => 'required|integer' ,

        ];
    }


    public function messages()
    {
        return [
        ];
    }

}
