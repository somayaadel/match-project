<?php

namespace App\Http\Requests\CategoryType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CategoryType ;
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

    public function all($keys = NULL){
        $request = Request::all();
        $request['id'] = $this->route('categoryType');
        $CategoryType = CategoryType::findOrFail($request['id']) ;
        $request['CategoryType_id'] = $CategoryType->CategoryType_id ;
        // dd($request) ;

        return $request ;
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
            'name' =>
            ['required',
            'string' ,

            ]
        ];
    }
}
