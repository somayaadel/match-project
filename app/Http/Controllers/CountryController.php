<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CountryRepository;

class CountryController extends Controller
{
    protected $country;

    public function __construct(CountryRepository $country)
    {
        $this->country = $country;
    }

    public function index(){
        return $this->country->all() ; 
    }

    public function store(Request $request){
        return $this->country->store($request) ; 
    }
    public function update(Request $request , $countryId ){
        return $this->country->update($request , $countryId) ; 
    }
    public function show($countryId){
        return  $this->country->show($countryId) ; 
    }
    public function destroy(Request $request , $countryId){
        return $this->country->destroy($request , $countryId) ; 
    }
}
