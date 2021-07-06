<?php

namespace App\Http\Controllers;
use App\Repositories\FieldRepository;

use Illuminate\Http\Request;
use App\Http\Requests\Field\StoreRequest ; 
use App\Http\Requests\Field\EditRequest ; 
use App\Http\Requests\Field\DestroyRequest ; 
use App\Http\Requests\Field\ShowRequest ; 

class FieldController extends Controller
{

    protected $field;





    public function __construct(FieldRepository $field)
    {
        $this->field = $field;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  $this->field->all(); 
    }
    public function store(Request $request)
    {   
        return $this->field->store($request);
    }
    public function create(Request $request)
    {   
        return $this->field->create($request);
    }
    public function show(ShowRequest $request , $id)
    {
        return $this->field->get($request , $id) ; 
    }
    public function update(EditRequest $request , $id)
    {
        return $this->field->update($request, $id) ;     
    }
    public function destroy(DestroyRequest $request , $id)
    { 
        return $this->field->destroy($request , $id) ; 
    }
    public function updateMultiple(Request $request){
        return $this->field->updateMultiple($request) ; 
    }
}
