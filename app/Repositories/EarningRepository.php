<?php
namespace App\Repositories;
use Illuminate\Http\Request;


use App\Models\Earning;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonImmutable;

class EarningRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */

    public function store(Request $request)
    {


    }

    public function show($Earning_id)
    {
        $Earning=Earning::find($Earning_id);
         return response()->json(['data' => $Earning]);
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        $Earning=Earning::with(['user','package','payment_method'])->get();
        if($Earning){
        return response()->json(['data' => $Earning]);
        }
        else
        return response()->json(['data'=>'error'] , 404);
    }


    public function recentEarnings(Request $request){
        $months = $request->months ; 
        
        
        if(!$months){
            return response()->json(['errors' =>['you have to provide months paramenter in the request']] , 500) ; 
        }
        $modifiedImmutable = Carbon::parse()->add(-1*$months, 'month');
        $application_id = $request->application_id ; 
        if(!$application_id){
            return response()->json(['errors' =>['you have to provide application_id paramenter in the request']] , 500) ; 
        }
        // 'start_date' , '>' , 1;
        $prices = User::where('application_id' , $application_id)->with(['allPackages'=>function($query) use($modifiedImmutable){
            $query->wherePivot('start_date' , '>' , $modifiedImmutable) ;
        }])->get()->pluck('allPackages')->flatten()->pluck('price')->sum() ; 
        return response()->json(['data'=>$prices] , 200);        
    }


    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($Earning_id)
    {
        $remove=Earning::destroy($Earning_id);
        if($remove){
        return response()->json(['data'=>'Earning removed successfully'] );

        }
        else
        return response()->json(['data'=>'error'] , 404);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($Earning_id, $request)
    {



    }
}
