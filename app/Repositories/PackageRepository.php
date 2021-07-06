<?php
namespace App\Repositories;

use App\Models\Feature;
use App\Models\Field;
use App\Models\Package;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */

    public function store(Request $request)
    {
        $package = new Package;
        $package->fill($request->all());
        $package->save();
        $features = collect($request->features);

        $features = $features->map(function ($feature) use ($package) {
            $feature['package_id'] = $package->id;
            return $feature;
        });
        // dd($features) ;

        $package->features()->attach($features);
        $package->save();

        if ($request->logoFile) {
            $image = $request->logoFile; // image base64 encoded
            preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
            $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
            $image = str_replace(' ', '+', $image);
            $imageName = 'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
            // dd(base64_decode($image)) ;
            $done = Storage::disk('public')->put('/packages/' . $package->id . '/' . $imageName, base64_decode($image));
            // dd($done) ;
            $package->logo = '/storage/packages/' . $package->id . '/' . $imageName;
            $package->save();
        }

        return response()->json(['data' => $package]);
    }
    public function create(Request $request)
    {
        $features = Feature::all();
        $fields = Field::where('application_id', $request['application_id'])->get();
        $roles = Role::where('name', '!=', 'admin')->get();
        return response()->json(['roles' => $roles, 'features' => $features, 'fields' => $fields]);

    }

    public function show(Request $request, $packageId)
    {
        $package = Package::with(['features', 'fields'])->findOrFail($packageId);
        return response()->json(['data' => $package]);
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        $packages = Package::with(['features', 'features.service'])->get();
        return response()->json(['data' => $packages]);
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function destroy(Request $request, $packageId)
    {
        return DestroyRepository::destroy(Package::class, $packageId);
    }
    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update(Request $request, $packageId)
    {

        $package = Package::findOrFail($packageId);
        $package->update($request->all());
        $package->save();
        $features = collect($request->features);
        $features = $features->map(function ($feature) use ($package) {
            $newFeature = [
                'package_id' => "",
                'limitation' => "",
                'feature_id' => "",
            ];

            $newFeature['package_id'] = $package->id;
            $newFeature['feature_id'] = $feature['feature_id'];
            $newFeature['limitation'] = $feature['limitation'];

            return $newFeature;
        });
        // dd($features);
        $package->features()->detach();
        // dd($package);
        $package->features()->attach($features);
        $package->save();

        if ($request->logoFile) {

            $image = $request->logoFile; // image base64 encoded
            preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
            $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
            $image = str_replace(' ', '+', $image);
            $imageName = 'image_' . time() . '.' . $image_extension[1]; //generating unique file name;
            // dd(base64_decode($image)) ;
            $done = Storage::disk('public')->put('/packages/' . $package->id . '/' . $imageName, base64_decode($image));
            // dd($done) ;

            $oldPath = substr($package->logo, 8);
            Storage::disk('public')->delete($oldPath);
            $package->logo = '/storage/packages/' . $package->id . '/' . $imageName;
            $package->save();
        }

        if ($request->fields) {
            $this->updateFields($request->fields, $package);
        } else {
            $package->fields()->detach();

        }
        return response()->json(['data' => $package]);
    }

    private function updateFields($fields, $package)
    {

        $fields = collect($fields);
        $package->fields()->detach();
        $fields = $fields->map(function ($field) use ($package) {
            $newField = [
                'package_id' => "",
                'field_id' => "",
            ];

            $newField['package_id'] = $package->id;
            $newField['field_id'] = $field['field_id'];

            return $newField;
        });
        $package->fields()->attach($fields);

    }
}
