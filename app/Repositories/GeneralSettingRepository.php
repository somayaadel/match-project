<?php
namespace App\Repositories;
use Illuminate\Http\Request;


use App\Models\GeneralSetting;

class GeneralSettingRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */




    public function update(Request $request , $application_id)
    {

        $GeneralSetting = GeneralSetting::where('application_id',$application_id)->first();
        $GeneralSetting->update($request->all());
        return response()->json(['data' => $GeneralSetting]) ;
    }
}
