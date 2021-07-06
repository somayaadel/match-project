<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserDataRepository;
use App\Http\Requests\UserData\StoreRequest ; 
class UserDataController extends Controller
{
    protected $userData;
    public function __construct(UserDataRepository $userData)
    {
        $this->userData = $userData;
    }
    public function store(StoreRequest $request){
        return $this->userData->store($request) ; 
    }
    public function update(Request $request , $id){
        return $this->userData->update($request , $id) ; 
    }
    public function create(Request $request ){
        return $this->userData->create($request) ;
    }
    public function destroy($userId){
        return $this->userData->destroy($userId) ; 
    }
}
