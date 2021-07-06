<?php

namespace App\Http\Controllers;
use App\Repositories\CategoryRepository;
use App\Http\Requests\Category\StoreRequest ;
use App\Http\Requests\Category\EditRequest ;
use App\Http\Requests\Category\DestroyRequest ;
use App\Http\Requests\Category\ShowRequest ;


use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $category;





    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->category->all($request) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function importCateg(Request $request)
    {
        return $this->category->importCateg($request) ;
    }

    public function store(Request  $request)
    {
        return $this->category->store($request) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request , $id)
    {
        return $this->category->get($id) ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditRequest $request , $id)
    {
        return $this->category->update($request,$id) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request ,$categoryId)
    {
        return $this->category->destroy($request , $categoryId);
    }
}
