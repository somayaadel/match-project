<?php

namespace App\Http\Requests\MailTemplate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Models\Application ;

class DestroyRequest extends FormRequest
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
        $request['id'] = $this->route('mailtemplate');
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
            'id' => 'required|integer|exists:mailtemplates,id'
        ];
    }


    public function messages()
    {
        return [
        ];
    }

}
