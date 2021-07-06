<?php

namespace App\Http\Controllers;
use App\Repositories\EarningRepository;
use App\Http\Requests\Earning\StoreRequest ;
use App\Http\Requests\Earning\EditRequest ;
use App\Http\Requests\Earning\DestroyRequest ;
use App\Http\Requests\Earning\ShowRequest ;
use App\Http\Requests\Earning\IndexRequest ;
use Illuminate\Http\Request;

class EarningController extends Controller
{

    protected $Earning;


    public function __construct(EarningRepository $Earning)
    {
        $this->Earning = $Earning;
    }

    public function index()
    {
        return $this->Earning->all();
    }
    public function create()
    {

    }

    public function recentEarnings(Request $request){
        return $this->Earning->recentEarnings($request );

    }

    public function store(StoreRequest $request)
    {

    }
    public function show(ShowRequest $request , $id)
    {
        return $this->Earning->show($request , $id);
    }
    public function update(EditRequest $request , $id)
    {

    }

    public function destroy(DestroyRequest $request ,$id)
    {
        return $this->Earning->destroy ($request ,$id);
    }
}
