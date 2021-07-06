<?php

namespace App\Http\Requests\ContactMessage;

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

    public function all($keys = NULL){
        $request = Request::all();
        $request['id'] = $this->route('application');
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
            'id' => 'required|integer|exists:applications,id'
        ];
    }
}
