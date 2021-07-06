<?php

namespace App\Http\Controllers;

use App\Repositories\GeneralSettingRepository;
use App\Http\Requests\GeneralSetting\EditRequest ;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    protected $GeneralSetting;

    public function __construct(GeneralSettingRepository $GeneralSetting)
    {
        $this->GeneralSetting = $GeneralSetting;
    }


    public function index(){
        return $this->GeneralSetting->all() ;


    }
    public function store(Request $request){
        return $this->GeneralSetting->store($request) ;
    }
    public function update(Request $request , $application_id ){
        return $this->GeneralSetting->update($request ,$application_id) ;
    }
    public function show($GeneralSettingId){
        return  $this->GeneralSetting->show($GeneralSettingId) ;
    }
    public function destroy(Request $request , $GeneralSettingId){
        return $this->GeneralSetting->destroy($request , $GeneralSettingId) ;
    }
    public function create(Request $request ){
        return $this->GeneralSetting->create($request ) ;
    }

}
