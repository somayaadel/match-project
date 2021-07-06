<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
    public function rules()
    {
        $request = $this ;
        return [
            'name' => ['required',
            'string' ,
            Rule::unique('categories')->where(function ($query) use ($request) {
                return $query
                    ->where('name' , $request->name)
                    ->where('category_type_id' , $request->category_type_id) ;
                    // ->whereNotIn('id', [$request->id]);
            })
            ] ,
            'category_type_id' => 'required|integer|exists:category_type,id',
        ];
    }
}
