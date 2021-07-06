<?php

namespace App\Http\Requests\Upload;

use App\Models\Feature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use DB ; 
class UploadVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->role->name == 'talanted' ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function all($keys = NULL){
        $request = Request::all();
        $user = Request::user() ; 
        $package = $user->userData->package ; 
        if(!$package){
            return $request ; 
        }
        $request['package_id'] = $package->id ; 
        $features = $package->features ; 
        
        $featrureLimitation  = 0 ; 
        foreach ($features as $key => $value) {
            if($value->service->name=='upload video'){
                $request['upload_video_feature'] = 'ture' ; 
                $featrureLimitation = $package->feature($value->id)->first()->pivot->limitation  ; 
                $feature_package_id = $package->feature($value->id)->first()->pivot->id ; 
                $useage = $user->featureUsage($value->id , $package->id)->first(); 
                if(!$useage){
                    DB::table('user_package_usage')->insert(['feature_usage'=>0 , 'package_id'=> $package->id , 'feature_id'=>$value->id , 'user_id'=>$user->id]) ; 
                    $useage = $user->featureUsage($value->id , $package->id)->first(); 
                }
                $featureUsage = ($useage->pivot->feature_usage) ;
                // dd($featureUsage) ;
                if($featureUsage<$featrureLimitation){
                    $request['feature_available'] = 'true' ; 
                    $request['usage'] = $useage->pivot ; 
                } 
            }
        }

        return $request ;
    }

    public function rules()
    {
        return [
            'package_id' => 'required|integer|exists:packages,id' ,
            'upload_video_feature' =>'required' , 
            'feature_available' => 'required' , 
        ];
    }


    public function messages()
    {
        return [
            'upload_video_feature.required' => 'this feature is not on this package' , 
            'feature_available.required' => 'u have reached the limitation' , 
        ];
    }
}
