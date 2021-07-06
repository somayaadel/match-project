<?php
namespace App\Repositories;

use App\factories\user\Company;
use App\factories\user\Staff;
use App\factories\user\Talanted;
use App\Models\Category;
use App\Models\Field;
use App\Models\Package;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserData;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */

    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'application_id' => $request->application_id,
            'user_code' => 'code',
        ]);
        $user->save();
        $user->user_code = $this->quickRandom(5, $request->application_id, $user->id);
        $user->save();
        $userData = new UserData([
            'gender' => $request->gender,
            'user_id' => $user->id,
            'phone' => ($request->phone) ? $request->phone : '111',
            'package_id' => $request->package_id,
            'birth_date' => Carbon::parse($request->birth_date),
        ]);
        if ($request->fields) {
            $userFieldRecords = [];
            foreach ($request->fields as $key => $value) {
                if (!$value) {
                    continue;
                }

                if (gettype($value) == 'array') {
                    $value = json_encode($value);
                }
                array_push($userFieldRecords, ['user_id' => $user->id, 'field_id' => $key, 'value' => $value]);
            }
            $user->fields()->attach($userFieldRecords);
        }
        if ($request->package_id) {
            $package = Package::findOrFail($request->package_id);
            $pacakgeStartDate = $request->package_start_date ? Carbon::create($request->package_start_date) : Carbon::now();
            $user->allPackages()->attach($request->package_id, [
                'start_date' => $pacakgeStartDate->toDateTimeString(),
                'end_date' => $pacakgeStartDate->addDays($package->duration)->toDateTimeString(),
            ]);
        }
        $userData->save();
        if ($request->profileImage) {
            $this->storePhoto($userData, 'profile_image', $request->profileImage);
        }
        $user = User::with(['userData', 'fields'])->findOrFail($user->id);
        return response()->json(['data' => $user]);
    }

    public function availableFields(Request $request)
    {
        $user = $request->user();
        $userData = $user->userData;
        $userPackage = $userData->package;
        $packageFieldsIds = $userPackage->fields->pluck('id');
        $fields = Field::where('application_id', $request->application_id)->where(function ($q) use ($packageFieldsIds) {$q->where('required', 1)->orWhereIn('id', $packageFieldsIds);})->get();
        return response()->json(['data' => $fields]);

    }

    public function update(Request $request, $userId)
    {

        $user = User::findOrFail($userId);

        $user->update([
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'application_id' => $request->application_id,
        ]);

        $userData = UserData::where('user_id', $user->id)->first();

        $userData->update([
            'gender' => ($request->gender) ? $request->gender : $request->user_data['gender'],
            'phone' => ($request->phone) ? $request->phone : $request->user_data['phone'],
            'package_id' => ($request->package_id) ? $request->package_id : $request->user_data['package_id'],
            'birth_date' => Carbon::parse(($request->birth_date) ? $request->birth_date : $request->user_data['birth_date']),
        ]);

        if ($request->package_id) {
            $package = Package::findOrFail($request->package_id);
            $pacakgeStartDate = $request->package_start_date ? Carbon::create($request->package_start_date) : Carbon::now();
            $user->allPackages()->attach($request->package_id, [
                'start_date' => $pacakgeStartDate->toDateTimeString(),
                'end_date' => $pacakgeStartDate->addDays($package->duration)->toDateTimeString(),
            ]);
        }

        if ($request->fields) {
            $user->fields()->detach();
            $userFieldRecords = [];
            foreach ($request->fields as $key => $value) {
                $field = Field::where([['name', '=', $key], ['application_id', '=', $request->application_id]])->first();
                if (gettype($value) == 'array') {
                    $value = json_encode($value);
                }
                array_push($userFieldRecords, ['user_id' => $user->id, 'field_id' => $field->id, 'value' => $value]);
            }
            $user->fields()->attach($userFieldRecords);
        }

        if ($request->profileImage) {
            $oldPath = substr($userData->profile_image, 8);
            Storage::disk('public')->delete($oldPath);
            $this->storePhoto($userData, 'profile_image', $request->profileImage);
        }

        return response()->json(['data' => $user, 'userData' => $userData]);
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

    private static function quickRandom($length = 5, $app_id, $user_id)
    {

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
        $code = $app_id . $user_id . $randomString;
        return $code;
    }

    public function show(Request $request, $userId)
    {
        $user = User::with(['userData.job', 'categories'])->findOrFail($userId);
        if ($user->role->name == 'company') {
            $user = Company::show($request, $userId);
        } else if ($user->role->name == 'talanted') {
            $user = Talanted::show($request, $userId);
        } else if ($user->role->name == 'staff') {
            $user = Staff::show($request, $userId);
        }
        return response()->json(['data' => $user]);
    }

    public function all(Request $request)
    {
        $users = [];

        if ($request->application_id) {
            $users = User::with(['application:id,name', 'role:id,name', 'userData.package'])->where('application_id', $request->application_id)->get();
        } else {
            $users = User::with(['application:id,name', 'role:id,name', 'userData.package'])->get();
        }

        return response()->json(['data' => $users]);
    }
    public function allStaff()
    {
        $role_id = Role::where('name', 'staff')->pluck('id');
        $users = User::with('userData')->where('role_id', $role_id)->get();
        return response()->json(['data' => $users]);
    }

    public function destroy(Request $request, $userId)
    {
        return DestroyRepository::destroy(User::class, $userId);
    }

    public function create(Request $request)
    {
        $categories = Category::with('categoryType')->where('application_id', $request['application_id'])->get();
        $packages = Package::with('features')->where('application_id', $request['application_id'])->get();
        $roles = Role::where('id', '!=', '1')->get();
        $fields = Field::where('application_id', $request['application_id'])->get();
        return response()->json(['categories' => $categories, 'fields' => $fields, 'packages' => $packages, 'roles' => $roles]);
    }
    public function companyUsers(Request $request)
    {
        $companyRole = Role::where('name', 'company')->first();

        if ($request->application_id) {
            $users = User::with(['userData.package', 'role'])->where('role_id', $companyRole->id)->where('application_id', $request->application_id)->get();
        } else {
            $users = User::with(['userData.package', 'role'])->where('role_id', $companyRole->id)->get();
        }
        return response()->json(['data' => $users]);
    }

    public function freeUsers(Request $request)
    {

        if ($request->application_id) {
            $users = UserData::with(['user.userData', 'user.role:id,name', 'user.application:id,name'])
                ->whereHas('user', function ($query) use ($request) {
                    $query->where('application_id', $request->application_id);
                })
                ->whereHas('package', function ($query) use ($request) {
                    $query->where('price', '=', 0);
                })->get()->pluck('user');
        } else {
            $users = UserData::with(['user.userData', 'user.role:id,name', 'user.application:id,name'])
                ->whereHas('package', function ($query) use ($request) {
                    $query->where('price', '=', 0);
                })->get()->pluck('user');
        }
        return response()->json(['data' => $users]);
    }

    public function premiumUsers(Request $request)
    {

        $freePackagesIds = Package::where('price', '>', 0)->get()->pluck('id');
        $users = UserData::with(['user.userData.package.features', 'user.application', 'user.role'])->whereIn('package_id', $freePackagesIds)->get()->pluck('user');
        if ($request->application_id) {
            $users = UserData::with(['user.userData.package.features', 'user.application', 'user.role'])->whereIn('package_id', $freePackagesIds)->whereHas('user', function ($query) use ($request) {$query->where('application_id', $request->application_id);})->get()->pluck('user');
        } else {
            $users = UserData::with(['user.userData.package.features', 'user.application', 'user.role'])->whereIn('package_id', $freePackagesIds)->get()->pluck('user');
        }
        return response()->json(['data' => $users]);
    }
    public function updatePackage(Request $request, $userId)
    {

        $user = User::findOrFail($userId);
        $role = $user->role;
        $userData = $user->userData;
        $package = Package::findOrFail($request->package_id);
        if ($package->role_id != $user->role->id) {
            return response()->json(['errors' => ["this package can't be assign on this " . $role->name . " user"]], 404);
        }
        $userData->package_id = $request->package_id;
        $userData->save();
        return response()->json(['data' => $userData], 200);
    }
    public function updateCategory(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $category_user = [];
        $request->categories_ids = collect($request->categories_ids)->unique();
        foreach ($request->categories_ids as $id) {
            $category = Category::findOrFail($id);
            if ($category->application_id != $request->application_id || $category->category_type_id != $request->type_id) {
                return response()->json(['error' => 'invalid id ' . $id], 404);
            }
            array_push($category_user, ['user_id' => $user->id, 'category_id' => $id]);
        }
        $categoriesIds = Category::where('category_type_id', $request->type_id)->pluck('id');
        DB::table('category_user')->where('user_id', '=', $userId)->whereIn('category_id', $categoriesIds)->delete();
        $user->categories($request->type_id)->attach($category_user);
        $user['categories'] = $user->categories;
        return response()->json(['data' => $user], 200);
    }
    public function toggleBlock(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->blocked = !$user->blocked;
        $user->save();
    }

    public function blockedUsers(Request $request)
    {
        $users = User::with(['userData.package.features', 'application', 'role'])->where('blocked', true)->get();
        return response()->json(['data' => $users]);
    }

    public function updateUserPermission(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->permissions()->detach();
        $user->permissions()->attach($request->all());

        return response()->json(['data' => $user]);
    }

    public function showUserPermission(Request $request, $userId)
    {
        $permissions = Permission::all();
        $permission_check = [];
        $user = User::where('id', $userId)->first();
        foreach ($permissions as $key => $permission) {
            if ($user->permissions->contains($permission)) {
                $permission_check[$key] = true;
            } else {
                $permission_check[$key] = false;
            }
        }
        return response()->json(['data' => $permission_check]);
    }

}
