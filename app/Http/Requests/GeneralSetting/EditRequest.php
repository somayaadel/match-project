<?php

namespace App\Http\Requests\GeneralSetting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EditRequest extends FormRequest
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
    public function all($keys = NULL){
        $request = Request::all();
        $request['record_id'] = $this->route('id');
        return $request ;
    }

    public function rules()
    {
        return [
            'record_id' => 'required|integer|exists:general_settings,id',
            'application_id' => 'required',
            'email' => 'required' ,
            'phone' => 'required' ,
            'time_zone' => 'required' ,
            'member_email_verification' => 'required|boolean' ,
            'member_profile_picture_admin_approve' => 'required|boolean' ,

        ];
    }


    public function messages()
    {
        return [
        ];
    }
}
