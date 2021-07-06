<?php
namespace App\Repositories;

use App\Models\Package;
use App\Models\Upload;
use App\Models\User;
use App\Models\UserData;
use DB;
use Illuminate\Http\Request;

class UploadRepository
{
    public function getPackageUsage(Request $request)
    {
        $user = user::where('id', $request->user()->id)->with('userData')->first();
        $package = Package::where('id', $user->userData->package_id)->with('features')->first();
        $packageFeaturesUsage = [];
        if ($package) {
            foreach ($package->features as $feature) {
                $usage = $user->featureUsage($feature->id, $user->userData->package_id)->first();
                $data = new uploadData();
                $data->id = $feature->id;
                $data->name = $feature->name;
                $data->name_ar = $feature->name_ar;
                $data->limitation = $feature->pivot->limitation;
                if (!$usage) {
                    $data->feature_usage = 0;
                } else {
                    $data->feature_usage = $usage->pivot->feature_usage;
                }
                $data->remaning_usage = $data->limitation - $data->feature_usage;
                array_push($packageFeaturesUsage, $data);

            }
        }
        return response()->json(['data' => $packageFeaturesUsage]);
    }
    public function getmedia(Request $request, $userId, $type)
    {
        $upload = Upload::where(['user_id' => $userId, 'type' => $type])->get();
        return response()->json(['data' => $upload]);

    }

    public function uploadPhoto(Request $request)
    {
        $user = $request->user();
        if ($request->photo) {
            $image = $request->photo;

            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/photos/' . $user->id . '/');
            $image->move($destinationPath, $imageName);
            $upload = Upload::create([
                'user_id' => $user->id,
                'path' => '/storage/uploads/photos/' . $user->id . '/' . $imageName,
                'type' => 'photo',
            ]);

            DB::table('user_package_usage')->where('id', $request['usage']->id)->update(['feature_usage' => $request['usage']->feature_usage + 1]);
            return response()->json(['data' => $upload]);
        } else {
            return response()->json(['no photo in the request'], 404);
        }
    }

    public function uploadVideo(Request $request)
    {
        $user = $request->user();
        if ($request->video) {
            $video = $request->video;

            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/videos/' . $user->id . '/');
            $video->move($destinationPath, $videoName);
            $upload = Upload::create([
                'user_id' => $user->id,
                'path' => '/storage/uploads/videos/' . $user->id . '/' . $videoName,
                'type' => 'video',
            ]);
            DB::table('user_package_usage')->where('id', $request['usage']->id)->update(['feature_usage' => $request['usage']->feature_usage + 1]);

            return response()->json(['data' => $upload]);
        } else {
            return response()->json(['no photo in the request'], 404);
        }
    }
}
class uploadData
{
    public $id;
    public $name;
    public $name_ar;
    public $limitation;
    public $feature_usage;
    public $remaning_usage;
}
