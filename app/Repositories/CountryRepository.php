<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Country ; 


class CountryRepository 
{


    public function all()
    {
        $countries =  Country::all();
        return response()->json(['data' => $countries]) ; 
    }

    public function store(Request $request)
    {
       

        $countryData = $request->validate([
            'name' => 'required|string' , 
            'name_ar' => 'required|string' , 
        ]);
        $country = new Country ;  
        $country->fill($countryData) ; 
        $country->save();  
        return response()->json(['country'=>$country] , 200) ; 
    }

    public function update( Request $request , $id)
    {
        $country = Country::findOrFail($id);

        $countryData = $request->validate([
            'name' => 'string' , 
            'name_ar' =>'string' , 
        ]);
        
        $country->update($countryData); 
        return response()->json(['data' => $country]) ; 
    }

    public function show($countryId){
        $country = Country::findOrFail($countryId) ; 
        return response()->json(['data'=>$country]) ; 
    }

   

    public function destroy(Request $request ,$countryId){
        return DestroyRepository::destroy(Country::class ,$countryId ); 
    }
}
