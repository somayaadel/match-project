<?php
namespace App\Repositories;
use Illuminate\Http\Request;


use App\Models\Feature;
use App\Models\Service;


class FeatureRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function create()
    {
        $Service =  Service::all();
        return response()->json(['data' =>  $Service]) ;
    }

    public function store(Request $request)
    {
        $feature = new Feature ;
        $feature->fill($request->all()) ;
        $feature->save() ;
        return response()->json(['data' => $feature]) ;
    }


    public function show(Request $request , $featureId)
    {
        $feature = Feature::findOrFail($featureId);
        return response()->json(['data'=>$feature]) ;
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {

        $features =  Feature::with('service')->get();
        return response()->json(['data' => $features]) ;
    }

    public function update(Request $request , $featureId )
    {
        $feature=Feature::findOrFail($featureId);
        $feature->update($request->all());
        $feature->save() ;
        return response()->json(['data' => $feature]) ;
    }

    public function destroy(Request $request ,$featureId)
    {
        return DestroyRepository::destroy(Feature::class ,$featureId );
    }
}
