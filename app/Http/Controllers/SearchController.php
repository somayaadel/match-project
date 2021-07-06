<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User ; 
use App\Models\UserData ; 
use App\Repositories\SearchRepository;

class SearchController extends Controller
{

    protected $search;
    public function __construct(SearchRepository $search)
    {
        $this->search = $search;
    }


    public function talantedSearch(Request $request){
        return $this->search->talantedSearch($request) ; 
    }


}
