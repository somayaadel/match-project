<?php

namespace App\Http\Requests\Earning;

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
        return $this->user()->role->name == 'admin' ;
    }

    public function all($keys = NULL){
        $request = Request::all();
        $request['id'] = $this->route('earning');
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
            'id' => 'required|integer|exists:earnings,id'
        ];
    }
}
