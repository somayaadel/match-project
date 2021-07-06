<?php

namespace App\Http\Controllers;
use App\Repositories\SubCategoryRepository;
use Illuminate\Http\Request;
use App\Http\Requests\SubCategory\StoreRequest ;
use App\Http\Requests\SubCategory\EditRequest ;
use App\Http\Requests\SubCategory\DestroyRequest ;
use App\Http\Requests\SubCategory\ShowRequest ;
use App\Http\Requests\SubCategory\IndexRequest ;

class SubCategoryController extends Controller
{


    protected $subCategory;
    public function __construct(SubCategoryRepository $subCategory)
    {
        $this->subCategory = $subCategory;
    }
    public function index()
    {
        return  $this->subCategory->all();
    }
    public function store(StoreRequest $request)
    {
        return $this->subCategory->store($request) ;
    }
    public function show(ShowRequest $request , $id)
    {
        return $this->subCategory->show($id);
    }
    public function update(EditRequest $request , $id)
    {
        return $this->subCategory->update($request , $id) ;
    }
    public function destroy(DestroyRequest $request , $subCategory_id)
    {
        return $this->subCategory->destroy($request , $subCategory_id) ;
    }
}
