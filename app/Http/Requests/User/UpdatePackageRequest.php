<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if( $this->user()->role->name == 'admin')return true  ; 
        // dd($this->user()->id) ; 
        // dd('here') ; 
        if($this->user()->id == $this->route('id')){
            // dd('here') ; 
            return true ; 
        }
        else{
            return false ; 
        }
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
