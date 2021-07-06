<?php

namespace App\Repositories;
use Illuminate\Support\Facades\Storage;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class DeleteRepository.
 */
abstract class DestroyRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    
     public static function destroy($modelName , $id){

         $record = $modelName::where('id',$id)->first() ; 
         if($record->logo){
            $oldPath = substr($record->logo, 8);
            Storage::disk('public')->delete($oldPath);
         }
         $record->delete() ; 
         return response()->json(['data'=> 'deleted successfuly']) ; 
     }
}
