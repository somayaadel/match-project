<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DestroyRequest;
use App\Http\Requests\User\ShowRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdatePackageRequest;
use App\Models\FollowUps;
use App\Models\Block;
use App\Models\Interaction;
use App\Models\User;
use App\Models\UserData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $user;
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function index(Request $request)
    {
        return $this->user->all($request);
    }

    public function store(StoreRequest $request)
    {
        return $this->user->store($request);
    }

    public function update(Request $request, $userId)
    {
        return $this->user->update($request, $userId);
    }
    public function show(ShowRequest $request, $userId)
    {
        return $this->user->show($request, $userId);
    }

    public function create(Request $request)
    {
        return $this->user->create($request);
    }

    public function destroy(DestroyRequest $request, $user_id)
    {
        return $this->user->destroy($request, $user_id);
    }
    public function freeUsers(Request $request)
    {
        return $this->user->freeUsers($request);
    }
    public function premiumUsers(Request $request)
    {
        return $this->user->premiumUsers($request);
    }
    public function updatePackage(UpdatePackageRequest $request, $userId)
    {
        return $this->user->updatePackage($request, $userId);
    }
    public function updateCategory(UpdatePackageRequest $request, $userId)
    {
        return $this->user->updateCategory($request, $userId);
    }

    public function allStaff()
    {
        return $this->user->allStaff();
    }

    public function toggleBlock(Request $request, $userId)
    {
        return $this->user->toggleBlock($request, $userId);
    }
    public function companyUsers(Request $request)
    {
        return $this->user->companyUsers($request);
    }

    public function blockedUsers(Request $request)
    {
        return $this->user->blockedUsers($request);
    }
    public function updateUserPermission(Request $request, $userId)
    {
        return $this->user->updateUserPermission($request, $userId);
    }
    public function showUserPermission(Request $request, $userId)
    {
        return $this->user->showUserPermission($request, $userId);
    }

    public function availableFields(Request $request)
    {
        return $this->user->availableFields($request);
    }
    public function getProfile(Request $request ){
        $user_id  = $request->user()->id;
        $user = User::where('id',$user_id)->with('userData' )->first() ;     
        $interests=$user->categories(1)->get();
        $actor_matching=$user->categories(2)->get();
        $myFollowers = FollowUps::where('following_id',$user_id)->count();
        // return $myFollowers;
        $myFollowings = FollowUps::where('follower_id',$user_id)->count();
        $image_uploads=$user->uploadsType('photo')->get();
        $vedios_uploads=$user->uploadsType('video')->get();
        $userSeen = Interaction::where(['user_id' => $user->id, 'seen' => 1])->count();

      return response()->json(['status' => 'success', 
      'user' => $user,
       'interests'=>$interests,
        'actor_matching'=>$actor_matching,
        'myFollowers'=>$myFollowers,
        'myFollowings'=>$myFollowings,
        '$image_uploads'=>$image_uploads,
        '$vedios_uploads'=>$vedios_uploads,
        'userSeen' => $userSeen
        ]);
    }
    public function updateProfile(Request $request ){
        // return $request;
        $user_id  = $request->user()->id;
        $user = User::where('id',$user_id)->with('userData' )->first() ;  
        $user_data = UserData::where('user_id',$user_id)->first() ;

        if($request->name){
            $user->name = $request->name;
        }
        if($request->name_ar){
            $user->name_ar = $request->name_ar;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if ($request->profile_image) {
            $image = $request->profile_image;
            // $imageName = time() . '.' . $image->extension();
            $imageName = $image->getClientOriginalName();
            Storage::disk('public')->put('/applications/' . $user_data->id . '/' . $imageName, file_get_contents($image));
            $user_data->profile_image = '/storage/applications/' . $user_data->id . '/' . $imageName;
        }
        if($request->resume){
            $user_data->resume = $request->resume;
        }
         if($request->phone){
            $user_data->phone = $request->phone;
            $user_data->phone_confirmed = 0 ;
            $user_data->phone_confirmation_code = 0 ;

        }
        if($request->hight){
            $user_data->hight = $request->hight;
        }
        if($request->weight){
            $user_data->weight = $request->weight;
        }
            $user->save();
            $user_data->save();
        if($request->category_ids){
            $actor_matching=$user->categories(2)->pluck('category_id');
            $user->categories()->detach($actor_matching);
            $user->categories()->attach($request->category_ids);
            $actor_matching=$user->categories(2)->get();
        }
        return response()->json(['status' => 'updated success']);
    }
    public function followMe(Request $request)
    {

        $follower_id = $request->user()->id;
        $following_id = $request->user_id;
        $followUps = new FollowUps();
        $followUps->follower_id = $follower_id;
        $followUps->following_id = $following_id;
        $followUps->save();
        return response()->json([
            'msg' => 'done',
        ]);

    }

    public function unFollow(Request $request){

        $follower_id = $request->user()->id;
        $following_id = $request->user_id;
        $followUps = FollowUps::where('follower_id',$follower_id)->where('following_id',$following_id)->delete();
        return response()->json([
            'msg' => 'done',
        ]);
    }
    public function myFollowersSearch(Request $request){

        $following_id =  $request->user()->id;
        $search = $request->searchTerm;
        $finalResult=[];
        $users = User::where('name', 'like', '%' . $search . '%')->orwhere('name_ar', 'like', '%' . $search . '%')->get();
        $myFollowers = FollowUps::where('following_id',$following_id)->pluck('follower_id')->toArray();
        foreach($users as $user){
           if(in_array($user->id,$myFollowers)){
               array_push($finalResult,$user);
           }
        }

        return response()->json([
            'myFollowers' => $finalResult,
        ]);

        
    }

    public function myFollowingsSearch(Request $request){

        $follower_id =  $request->user()->id;
        $search = $request->searchTerm;
        $finalResult=[];
        $users = User::where('name', 'like', '%' . $search . '%')->orwhere('name_ar', 'like', '%' . $search . '%')->get();
        $myFollowings = FollowUps::where('follower_id',$follower_id)->pluck('following_id')->toArray();
        foreach($users as $user){
           if(in_array($user->id,$myFollowings)){
               array_push($finalResult,$user);
           }
        }

        return response()->json([
            'myFollowings' => $finalResult,
        ]);

        
    }


    public function myFollowers(Request $request){
        
        $following_id =  $request->user()->id;
        $myFollowings = FollowUps::where('follower_id',$following_id )->pluck('following_id')->toArray();
        $myFollowers = FollowUps::where('following_id',$following_id)->with('followerUsers.userData')->get();
        foreach($myFollowers as $follower){
            if(in_array($follower->follower_id,$myFollowings)){
                $follower['IfollowYou']= true;
            }else{
                $follower['IfollowYou']= false;
            }
        }
        return response()->json([
            'myFollowers' => $myFollowers,
        ]);

    }

    public function myFollowings(Request $request){
    
        $follower_id =  $request->user()->id;
        $myFollowings = FollowUps::where('follower_id',$follower_id)->with('followingUsers.userData')->get();
        return response()->json([
            'myFollowings' => $myFollowings,
        ]);

    }
    public function updatePassword(Request $request)
    {
        $user = $request->user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => bcrypt($request->password)]);
            return response()->json(['status' => 'success', 'message' => 'password updated']);
        }
        else{
            return response()->json(['status' => 'failed', 'message' =>'Incorrect Password']);
        }
    }

    public function block(Request $request){

        $user_id = $request->user()->id;
        $blocked_id = $request->blocked_id;
        $block = new Block();
        $block->user_id = $user_id;
        $block->blocked_id = $blocked_id;
        $block->report_id = $request->report_id;
        $block->save();
        return response()->json([
            'msg' => 'done',
        ]);
    }

    public function unBlock(Request $request){

        $user_id = $request->user()->id;
        $blocked_id = $request->unblocked_id;
        $block =Block::where('user_id',$user_id)->where('blocked_id',$blocked_id)->delete();
        return response()->json([
            'msg' => 'done',
        ]);
    }

    public function myBlockList(Request $request){
        $user_id = $request->user()->id;
        $blockList = Block::where('user_id',$user_id)->with('blockedUsers')->get();
        return response()->json([
            'blockList' => $blockList,
        ]);

    }

   


}
