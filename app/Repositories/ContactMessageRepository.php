<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


use App\Models\Application;

class ContactMessageRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */

    public function store(Request $request)
    {
        

    }

    public function show($applicationId)
    {
         $application = Application::findOrFail($applicationId);
         return response()->json(['data'=>$application]) ; 

    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        $applications =  Application::all();
        return response()->json(['data' => $applications]) ; 
    }

  
    
    public function update($request , $applicationId)
    {
        $application=Application::findOrFail($applicationId);
        $application->update($request->all());
        $application->save() ; 

        if($request->logoFile){
            $image = $request->logoFile; // image base64 encoded
            preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
            $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
            $image = str_replace(' ', '+', $image);
            $imageName =  'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
            // dd(base64_decode($image)) ; 
            $done = Storage::disk('public')->put('/applications/' . $application->id . '/' . $imageName, base64_decode($image));
            // dd($done) ; 

            $oldPath = substr($application->logo, 8);
            Storage::disk('public')->delete($oldPath);
            $application->logo = '/storage/applications/' . $application->id . '/' . $imageName;
            $application->save();
        }

        return response()->json(['data' => $application]) ; 
    }

    public function destroy(Request $request ,$applicationId)
    {
        return DestroyRepository::destroy(Application::class ,$applicationId ); 
    }

}
