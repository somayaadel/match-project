<?php

namespace App\Http\Requests\ContactMessage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Category ; 
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
        $request['id'] = $this->route('category');
        $category = Category::findOrFail($request['id']) ; 
        $request['application_id'] = $category->application_id ; 
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
            Rule::unique('categories')->where(function ($query) use ($request) {
                return $query->where('name' , $request->name)->where('application_id' , $request->application_id)  ->whereNotIn('id', [$request->id]);
            })
            ]
        ];
    }
}
