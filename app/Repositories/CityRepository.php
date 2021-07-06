<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\City ;
use App\Models\Country;

class CityRepository 
{

    public function all($request)
    {
        if($request->country_id)$cities =  City::where('country_id' , $request->country_id)->get();
        else $cities =  City::all();
        return response()->json(['data' => $cities]) ; 
    }

    public function store(Request $request)
    {
       
        $cityData = $request->validate([
            'name' => 'required|string' , 
            'name_ar' => 'required|string' , 
            'country_id' => 'required|integer|exists:countries,id'
        ]);
        $city = new City ;  
        $city->fill($cityData) ; 
        $city->save();  
        return response()->json(['country'=>$city] , 200) ; 
    }

    public function update( Request $request , $id)
    {
        
        $city = City::findOrFail($id);

        $cityData = $request->validate([
            'name' => 'required|string' , 
            'name_ar' => 'required|string' , 
            'country_id' => 'required|integer|exists:countries,id'
        ]);
        
        $city->update($cityData); 
        return response()->json(['data' => $city]) ; 
    }

    public function show($cityId){
        $city = City::findOrFail($cityId) ; 
        return response()->json(['data'=>$city]) ; 
    }

    public function create(Request $request){
        $countries = Country::all() ; 
        return response()->json(['countries'=>$countries]) ; 
    }
   

    public function destroy(Request $request ,$cityId){
        return DestroyRepository::destroy(City::class ,$cityId ); 
    }


}
