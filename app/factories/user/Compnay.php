<?php
namespace App\factories\user ;
use App\Interfaces\userInterface ;
use Illuminate\Http\Request;
use App\Models\User ;

class Company implements  userInterface{
    public function index(){

    }
    public static function show(Request $request , $id){
        return $user = User::with(['userData','userData.job','userData.city','userData.religion','userData.package','categories'])->findOrFail($id) ;

    }
}
