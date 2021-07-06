<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator ; 
use Illuminate\Pagination\LengthAwarePaginator ; 

use App\Models\UserData;
use App\Models\User;
use DB ; 
use Carbon\Carbon;
class SearchRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */

    private function processFilterAge($filter){
        if(array_key_exists('__min_age' , $filter)){
            $filter['__max_birth_date'] = $this->ageToBirthDate($filter['__min_age']) ;  
            unset($filter['__min_age']) ; 
        }
        if(array_key_exists('__max_age' , $filter)){
            $filter['__min_birth_date'] = $this->ageToBirthDate($filter['__max_age']) ;  
            unset($filter['__max_age']) ; 
        }
        return $filter ; 
    }

    public function talantedSearch(Request $request){
        $filter = $request->all() ;
        $filter = $this->processFilterAge($filter) ; 

        $UserDataWhereFilter = [] ; 
        $UserWhereFilter = [] ; 
        $FieldPivotWhereFilter = [] ; 
        $column = "" ; 
        $operator = "" ; 
        foreach ($filter as $key => $value) {
            
            
            if(Str::startsWith($key , 'application_id')){
                array_push($UserWhereFilter , ['application_id' , '=' , $request['application_id']]) ;    
                continue ;
            }
            else if(Str::startsWith($key , '__equal_name')){
                array_push($UserWhereFilter , ['name' , '=' , $request['application_id']]) ;    
                continue ;
            }
            else if(Str::startsWith($key , '__contain_name')){
                array_push($UserWhereFilter , ['name' , 'LIKE' , '%'. $value .'%' ]) ;    
                continue ;
            }
            else if(Str::startsWith($key , 'page')){
                continue ;
            }
            else if(Str::startsWith($key , '__min_')){
                if(Str::startsWith($key , '__min_field')){
                    $fieldId  = substr($key, 11);
                    array_push($FieldPivotWhereFilter , ['value' , '>' , $value ,   $fieldId  ]) ;
                    continue ;

                }
                else{
                    $column  = substr($key, 6);
                    $operator = '>' ; 
                }
            }
            else if(Str::startsWith($key , '__max_')){
                if(Str::startsWith($key , '__max_field')){
                    $fieldId  = substr($key, 11);
                    array_push($FieldPivotWhereFilter , ['value' , '<' ,  $value ,   $fieldId]) ;
                    continue ;

                }
                else {
                    $column  = substr($key, 6);
                    $operator = '<' ;
                }
            }
            else if(Str::startsWith($key, '__contain_')){
                if(Str::startsWith($key , '__contain_field')){
                    $fieldId  = substr($key, 15);
                    array_push($FieldPivotWhereFilter , ['value' , 'LIKE' , '%'. $value .'%' ,   $fieldId]) ;
                    continue ;

                }
                else {
                    $column  = substr($key, 11);
                    $operator = 'LIKE' ; 
                }
            }
            else if(Str::startsWith($key, '__equal_')){
                if(Str::startsWith($key , '__equal_field')){
                    $fieldId  = substr($key, 13);
                    array_push($FieldPivotWhereFilter , ['value' , '=' , $value ,  $fieldId ]) ;
                    continue ;

                }
                else {
                    $column  = substr($key, 8);
                    $operator = '=' ; 
                }
            }
            array_push($UserDataWhereFilter , [$column , $operator , $value]) ;    
        }
        // dd($whereFilter) ; 
        $fields = DB::table('field_user') ; 
        foreach($FieldPivotWhereFilter as $filter){
            $fields = $fields->where(function($q) use($filter){
                $q->where('field_id' , $filter[3] )->where($filter[0] , $filter[1] , $filter[2] ) ; 
            }) ; 
        }
        $fieldsUsersIds = $fields->pluck('user_id') ; 
        // dd($fieldsUsersIds) ; 
        $usersId = "" ; 
        if(count($FieldPivotWhereFilter)==0){
            $usersId = User::where($UserWhereFilter)->pluck('id') ; 
        }
        else{
            $usersId = User::whereIn('id' , $fieldsUsersIds)->where($UserWhereFilter)->pluck('id') ; 
        }
        // dd($UserDataWhereFilter) ; 
        // dd($usersId) ; 
        $records = UserData::with(["user.userData"])->whereIn('user_id' , $usersId)->where($UserDataWhereFilter)->get()->pluck('user') ; 
        // dd($records) ; 
        $records = $this->paginate($records , 15 , $request['page']) ; 
        return response()->json(['data' => $records]) ;

    }

    public function ageToBirthDate($age){
        return Carbon::now()->subYears($age)->toDateString();  
    }
    
  


    private function paginate($items, $pageSize = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        return new LengthAwarePaginator($items->forPage($page, $pageSize), $items->count(), $pageSize, $page, $options);
    }


}
