<?php

namespace App\Http\Controllers;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Application\StoreRequest ;
use App\Http\Requests\Application\EditRequest ;
use App\Http\Requests\Application\DestroyRequest ;
use App\Http\Requests\Application\ShowRequest ;
use App\Http\Requests\Application\IndexRequest ;

class ApplicationController extends Controller
{


    protected $application;
    public function __construct(ApplicationRepository $application)
    {
        $this->application = $application;
    }
    public function index()
    {
        return  $this->application->all();
    }
    public function store(StoreRequest $request)
    {
        return $this->application->store($request) ;
    }
    public function show(ShowRequest $request , $id)
    {
        return $this->application->show($id);
    }
    public function update(EditRequest $request , $id)
    {
        return $this->application->update($request , $id) ;
    }
    public function destroy(DestroyRequest $request , $application_id)
    {
        return $this->application->destroy($request , $application_id) ;
    }
}
