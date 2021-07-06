<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CityRepository;

class CityController extends Controller
{
    protected $city;

    public function __construct(CityRepository $city)
    {
        $this->city = $city;
    }


    public function index(Request $request){
        return $this->city->all($request) ; 
    }

    public function store(Request $request){
        return $this->city->store($request) ; 
    }
    public function update(Request $request , $cityId ){
        return $this->city->update($request , $cityId) ; 
    }
    public function show($cityId){
        return  $this->city->show($cityId) ; 
    }
    public function destroy(Request $request , $cityId){
        return $this->city->destroy($request , $cityId) ; 
    }
    public function create(Request $request ){
        return $this->city->create($request ) ; 
    }

}
