<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function importCateg(Request $request)
    {
        $data=$request->all();
        $i = 0;
        while ($i < sizeof($data))
        {

            $Category=[];
            $category['name']=$data[$i]['name'];
            $category['name_ar']=$data[$i]['name_ar'];
            $category['image']=$data[$i]['image'];
            $category['type']=$data[$i]['type'];
            Category::create($category)  ;
            $i++;
        }
        $response=Category::all();
        return response()->json(['data' => $response]) ;
    }

    public function store(Request $request)
    {

        // dd($request->except('done')) ;
        $category= new Category ;
        $category->fill($request->except(['done' , 'image'])) ;
        $category['image'] = '' ;
        $category->save() ;
        if($request->image){
            $this->storePhoto($category , 'image' , $request->image) ;
        }
        else{
            return response()->json(['error' => 'u hav to upload photo'] , 404) ;
        }
        return response()->json(['data' => $category]) ;
    }

    private function storePhoto($rec , $coulmnName , $image){
        preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
        $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
        $image = str_replace(' ', '+', $image);
        $imageName =  'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
        // dd(base64_decode($image)) ;
        $done = Storage::disk('public')->put('/applications/' . $rec->id . '/' . $imageName, base64_decode($image));
        // dd($done) ;
        $rec[$coulmnName] = '/storage/applications/' . $rec->id . '/' . $imageName;
        $rec->save();
}

    public function get($Category_id)
    {
         $category = Category::with("categoryType")->findOrFail($Category_id);
         return response()->json(['data'=>$category]) ;

    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all(Request $request)
    {
        // dd($request->all()) ;
        $categories = Category::where('application_id' , $request['application_id'])->with('categoryType') ;
        if($request->category_type_id){
            $categories = $categories->where('category_type_id' , $request->category_type_id)->get() ;
        }
        else{
            $categories = $categories->get() ;
        }
        return response()->json(['data'=>$categories]) ;
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function destroy(Request $request , $categoryId)
    {
        return DestroyRepository::destroy(Category::class ,$categoryId );
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($request , $categoryId)
    {

        $category=Category::findOrFail($categoryId);
        $category->update($request->all());
        $category->save() ;
        return response()->json(['data' => $category]) ;
    }
}
