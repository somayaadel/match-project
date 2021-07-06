<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ShowRequest extends FormRequest
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
        if($this->user()->id == $this->route('user')){
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

    public function all($keys = NULL){
        $request = Request::all();
        $request['id'] = $this->route('user');
        return $request ; 
    }

    public function rules()
    {
        return [
            'id' => 'required|integer|exists:users,id'
        ];
    }
}
