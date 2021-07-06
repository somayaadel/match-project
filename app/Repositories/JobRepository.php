<?php
namespace App\Repositories;
use Illuminate\Http\Request;


use App\Models\Job;

class JobRepository
{
    public function all()
    {
        $cities =  job::all();
        return response()->json(['data' => $cities]) ; 
    }

    public function store(Request $request)
    {
       
        $jobData = $request->validate([
            'name' => 'required|string' , 
            'name_ar' => 'required|string' , 
        ]);
        $job = new job ;  
        $job->fill($jobData) ; 
        $job->save();  
        return response()->json(['job'=>$job] , 200) ; 
    }

    public function update( Request $request , $id)
    {
        
        $job = job::findOrFail($id);

        $jobData = $request->validate([
            'name' => 'required|string' , 
            'name_ar' => 'required|string' , 
        ]);
        
        $job->update($jobData); 
        return response()->json(['data' => $job]) ; 
    }

    public function show($jobId){
        $job = job::findOrFail($jobId) ; 
        return response()->json(['data'=>$job]) ; 
    }

    public function create(Request $request){
 
    }
   

    public function destroy(Request $request ,$jobId){
        return DestroyRepository::destroy(job::class ,$jobId ); 
    }


}
