<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


use App\Models\CategoryType;

class CategoryTypeRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */

    public function store(Request $request)
    {

        $categorytype = new CategoryType ;
        $categorytype->fill($request->all()) ;
        $categorytype->save() ;


        return response()->json(['data' => $categorytype]) ;
    }

    public function show($categorytypeId)
    {
         $categorytype = CategoryType::findOrFail($categorytypeId);
         return response()->json(['data'=>$categorytype]) ;

    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        $categorytypes =  CategoryType::all();
        return response()->json(['data' => $categorytypes]) ;
    }



    public function update(Request $request , $categorytypeId)
    {
        $categorytype=CategoryType::findOrFail($categorytypeId);
        $categorytype->update($request->all());
        return response()->json(['data' => $categorytype]) ;
    }

    public function destroy(Request $request ,$CategoryTypeId)
    {
        return DestroyRepository::destroy(CategoryType::class ,$CategoryTypeId );
    }

}
