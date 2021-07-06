<?php
namespace App\factories\user ;
use App\Interfaces\userInterface ;
use App\Models\User ;
use App\Models\Field ;

use Illuminate\Http\Request;

class Talanted implements  userInterface{
    public function index(){
    }
    public static function show(Request $request , $id){
        $applicationFields = Field::where('application_id' , $request['application_id'])->get() ; 
        $user = [] ; 
        $user = User::with([ 'allPackages' , 'fields', 'userData','userData.job','userData.city','userData.religion','userData.package.fields' , 'userData.package.features' ,'categories'])->findOrFail($id) ;
        foreach($applicationFields as $index => $field){
            $vv = $user->fields($field['id'])->first();
            if($vv){
                $vv = $vv->pivot->value ; 
            } 
            $user['userData'][$field['name']] = $vv ; 
        } 
        return $user ; 
    }
}
