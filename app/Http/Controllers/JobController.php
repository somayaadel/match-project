<?php

namespace App\Http\Controllers;
use App\Repositories\JobRepository;

use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $job;

    public function __construct(JobRepository $job)
    {
        $this->job = $job;
    }


    public function index(){
        return $this->job->all() ; 
    }
    public function store(Request $request){
        return $this->job->store($request) ; 
    }
    public function update(Request $request , $jobId ){
        return $this->job->update($request , $jobId) ; 
    }
    public function show($jobId){
        return  $this->job->show($jobId) ; 
    }
    public function destroy(Request $request , $jobId){
        return $this->job->destroy($request , $jobId) ; 
    }
    public function create(Request $request ){
        return $this->job->create($request ) ; 
    }
}
