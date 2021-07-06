<?php

namespace App\Http\Requests\Follow;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Application ; 

class FollowRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        return $this->user()->role->name == 'company' ; 
    }
    public function all($keys = NULL){
        $request = Request::all();
        $request['user_id'] = $this->route('user_id');
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
            'user_id' => ['required' , 'integer' , ]
        ];
    }


    public function messages()
    {
        return [
            'id.exists'=>"this field id isn't exists" 
        ];
    }

}
