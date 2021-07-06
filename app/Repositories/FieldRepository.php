<?php
namespace App\Repositories;
use Illuminate\Http\Request;


use App\Models\Field;
use App\Models\Role ; 
class FieldRepository
{


    public function store(Request $request)
    {
      
        $data = $request->all() ; 
        $field = new Field ; 
        // $data['items'] = json_encode($data['items']) ; 
        $field->fill($data) ; 
        $field->save() ; 

        return response()->json(['data' => $field]) ; 

    }

    public function get(Request $request ,  $fieldId)
    {
         $field = Field::where('id' , $fieldId)->first();
         return response()->json(['data'=>$field]) ; 
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        $fields = Field::all() ; 
        return response()->json(['data'=>$fields]) ; 
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
   
    public function create(Request $request){
        $roles = Role::where('name' , '!=' , 'admin')->get() ; 
        return response()->json([ 'roles'=>$roles ]) ;

    }

    public function destroy(Request $request ,$fieldId)
    {
        return DestroyRepository::destroy(Field::class ,$fieldId ); 
    }
    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($request , $fieldId){
        $field=Field::findOrFail($fieldId);
        // dd($request->all()) ; 
        $field->update($request->all());
        $field->save() ; 
        return response()->json(['data' => $field]) ; 
    }
    public function updateMultiple(Request $request){
        foreach($request->all() as $field){
            $fieldRec = Field::findOrFail($field['id']) ; 
            $fieldRec->update($field) ; 
            $fieldRec->save() ; 
        }
    }
}
