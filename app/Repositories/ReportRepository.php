<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Report ; 


//use Your Model

/**
 * Class ReportRepository.
 */
class ReportRepository 
{
    /**
     * @return string
     *  Return the model
     */
    public function all()
    {
        $report =  Report::all();
        return response()->json(['data' => $report]) ; 
    }
    public function store(Request $request)
    {
       

        $reportData = $request->validate([
            'reason' => 'required|string' , 
        ]);
        $report = new Report ;  
        $report->fill($reportData) ; 
        $report->save();  
        return response()->json(['country'=>$report] , 200) ; 
    }
    public function update( Request $request , $id)
    {
        $report = Report::findOrFail($id);

        $reportData = $request->validate([
            'reason' => 'required|string' , 
          
        ]);
        
        $report->update($reportData); 
        return response()->json(['data' => $report]) ; 
    }

    public function show($reportId){
        $report = Report::findOrFail($reportId) ; 
        return response()->json(['data'=>$report]) ; 
    }
    public function destroy(Request $request ,$reportId){
        return DestroyRepository::destroy(Report::class ,$reportId ); 
    }
    public function model()
    {
        //return YourModel::class;
    }
}
