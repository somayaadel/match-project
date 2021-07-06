<?php

namespace App\Http\Controllers;
use App\Repositories\FeatureRepository;
use App\Http\Requests\Feature\StoreRequest ;
use App\Http\Requests\Feature\EditRequest ;
use App\Http\Requests\Feature\DestroyRequest ;
use App\Http\Requests\Feature\ShowRequest ;
use App\Http\Requests\Feature\IndexRequest ;
use Illuminate\Http\Request;

class FeatureController extends Controller
{

    protected $feature;


    public function __construct(FeatureRepository $feature)
    {
        $this->feature = $feature;
    }

    public function index()
    {
        return $this->feature->all();
    }
    public function create()
    {
        return $this->feature->create();
    }
    public function store(StoreRequest $request)
    {
        return $this->feature->store($request);
    }
    public function show(ShowRequest $request , $id)
    {
        return $this->feature->show($request , $id);
    }
    public function update(EditRequest $request , $id)
    {
        return $this->feature->update($request , $id) ;
    }

    public function destroy(DestroyRequest $request ,$id)
    {
        return $this->feature->destroy ($request ,$id);
    }
}
