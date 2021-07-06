<?php
namespace App\Repositories;
use Illuminate\Http\Request;


use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;


class SubcategoryRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */

    public function store(Request $request)
    {
        if($request){
            $Subcategory=SubCategory::create($request->all());
            if($request->logoFile){
                $image = $request->logoFile; // image base64 encoded
                preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
                $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
                $image = str_replace(' ', '+', $image);
                $imageName =  'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
                // dd(base64_decode($image)) ;
                $done = Storage::disk('public')->put('/subcategory/' . $Subcategory->id . '/' . $imageName, base64_decode($image));
                // dd($done) ;
                $Subcategory->logo = '/storage/subcategory/' . $Subcategory->id . '/' . $imageName;
                $Subcategory->save();
            }
            return response()->json(['data'=>$Subcategory] );
        }
    else
    return response()->json(['data'=>'error'] , 404);


    }

    public function show($Subcategory_id)
    {
        $Subcategory=SubCategory::find($Subcategory_id);
        return response()->json(['data' => $Subcategory]);
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        $Subcategory=SubCategory::all();
        if($Subcategory){
        return response()->json(['data' => $Subcategory]);
        }
        else
        return response()->json(['data'=>'error'] , 404);

    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function destroy($request , $Subcategory_id)
    {
        return DestroyRepository::destroy(SubCategory::class , $Subcategory_id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($request , $Subcategory_id)
    {
        $Subcategory=SubCategory::find($Subcategory_id);
        $Subcategory_request_data=$request->all();

        $Subcategory->update($Subcategory_request_data);

        if($request->logoFile){
            $image = $request->logoFile; // image base64 encoded
            preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
            $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
            $image = str_replace(' ', '+', $image);
            $imageName =  'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
            // dd(base64_decode($image)) ; 
            $done = Storage::disk('public')->put('/subcategory/' . $Subcategory->id . '/' . $imageName, base64_decode($image));
            // dd($done) ; 

            $oldPath = substr($Subcategory->logo, 8);
            Storage::disk('public')->delete($oldPath);
            $Subcategory->logo = '/storage/subcategory/' . $Subcategory->id . '/' . $imageName;
            $Subcategory->save();
        }

        return response()->json(['data'=>$Subcategory] );



    }
}
