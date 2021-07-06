<?php

namespace App\Http\Controllers;
use App\Repositories\CategoryTypeRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryType\StoreRequest ;
use App\Http\Requests\CategoryType\EditRequest ;
use App\Http\Requests\CategoryType\DestroyRequest ;
use App\Http\Requests\CategoryType\ShowRequest ;
use App\Http\Requests\CategoryType\IndexRequest ;

class CategoryTypeController extends Controller
{


    protected $CategoryType;
    public function __construct(CategoryTypeRepository $CategoryType)
    {
        $this->CategoryType = $CategoryType;
    }
    public function index()
    {
        return  $this->CategoryType->all();
    }
    public function store(StoreRequest $request)
    {
        return $this->CategoryType->store($request) ;
    }
    public function show(ShowRequest $request , $id)
    {
        return $this->CategoryType->show($id);
    }
    public function update(EditRequest $request , $id)
    {
        return $this->CategoryType->update($request , $id) ;
    }
    public function destroy(DestroyRequest $request , $CategoryType_id)
    {
        return $this->CategoryType->destroy($request , $CategoryType_id) ;
    }
}
