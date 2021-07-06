<?php
namespace App\Repositories;

use App\Models\Field;
use App\Models\Package;
use App\Models\Role;
use App\Models\User;
use App\Models\UserData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserDataRepository
{

    public function store(Request $request)
    {
        // dd($request->all()) ;
        // return response()->json($request->user());
        // return 'UserDataRepository@store' ;

        ($request['gender'] == 'male') ? $request['gender'] = 0 : $request['gender'] = 1;
        if ($request->porfile_image) {

        }
        $userData = new UserData;
        $userData['birth_date'] = Carbon::parse($request->birth_date)->format('Y M d');
        // dd($userData ) ;
        $userData->fill($request->all());
        $userData->weight = $request->weight;
        $userData->hight = $request->hight;
        $userData->save();

        if ($request->profileImage) {
            $this->storePhoto($userData, 'profile_image', $request->profileImage);
        }

        return response()->json(['data' => $userData]);
    }

    public function create(Request $request)
    {
        $packages = Package::all();
        $roles = Role::where('id', '!=', '1')->get();

        $fields = Field::where('application_id', $request['application_id'])->where('required', 1)->get();
        return response()->json(['fields' => $fields, 'packages' => $packages, 'roles' => $roles]);
    }

    public function update(Request $request)
    {

        $userId = $request->user_id;
        $user = User::findOrFail($userId);
        $userData = $user->userData;
        $applicationFields = Field::where('application_id', $request['application_id'])->get();
        $userFieldRecords = [];

        if ($request->fields) {
            foreach ($request->fields as $key => $value) {
                // if (Schema::hasColumn('user_data', $key)) {
                //     $userData[$key] = $value;
                // }
                foreach ($applicationFields as $index => $field) {

                    if ($value['name'] == $field['name']) {
                        if ($user->fields->contains($field['id'])) {
                            $user->fields()->detach($field['id']);
                        }
                        if (gettype($value['data']) == 'array') {
                            $value['data'] = json_encode($value['data']);
                        }
                        $user->fields()->attach([['user_id' => $user->id, 'field_id' => $field['id'], 'value' => $value['data']]]);
                    }
                }
            }
        }
        if ($request->city_id) {
            $userData->city_id = $request->city_id;
        }
        if ($request->userData) {
            $gender = 1;
            ($request->userData['gender'] == 'male') ? $gender = 0 : '';
            $userData->birth_date = Carbon::parse($request->userData['birth_date'])->format('Y-m-d');
            $userData->gender = $gender;
            $userData->weight = $request->userData['weight'];
            $userData->hight = $request->userData['hight'];
        }
        $userData->save();

        if ($request->profileImage) {
            $oldPath = substr($userData->profile_image, 8);
            Storage::disk('public')->delete($oldPath);
            $this->storePhoto($userData, 'profile_image', $request->profileImage);
        }

        $user = $userData->user;
        $user['user_data'] = $user->userData;

        foreach ($applicationFields as $index => $field) {
            $vv = $user->fields($field['id'])->first();
            if ($vv) {
                $vv = $vv->pivot->value;
                $user['user_data'][$field['name']] = $vv;
            }
        }
        return response()->json(['data' => $user]);
    }

    private function storePhoto($rec, $coulmnName, $image)
    {
        preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
        $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
        $image = str_replace(' ', '+', $image);
        $imageName = 'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
        // dd(base64_decode($image)) ;
        $done = Storage::disk('public')->put('/applications/' . $rec->id . '/' . $imageName, base64_decode($image));
        // dd($done) ;
        $rec[$coulmnName] = '/storage/applications/' . $rec->id . '/' . $imageName;
        $rec->save();
    }

    public function destroy($userId)
    {
        $userDataId = User::findOrFail($userId)->userData->id;

        return DestroyRepository::destroy(UserData::class, $userDataId);
    }
}
