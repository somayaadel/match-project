<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request = $this;

        return [
            'name' => 'required',
            'application_id' => 'required|exists:applications,id',
            'email' => ['required',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query
                        ->where('email', $request['email'])
                        ->where('application_id', $request['application_id']);
                    // ->whereNotIn('id', [$request->id]);
                }),
            ],
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
