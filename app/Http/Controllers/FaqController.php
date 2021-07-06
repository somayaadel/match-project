<?php

namespace App\Http\Controllers;
use App\Repositories\FaqRepository;

use Illuminate\Http\Request;

class FaqController extends Controller
{

    protected $faq;


    public function __construct(FaqRepository $faq)
    {
        $this->faq = $faq;
    }

    public function index()
    {
        return $this->faq->all();
    }
    public function create()
    {
        return $this->faq->create();
    }

    public function store(Request $request)
    {
        return $this->faq->store($request);
    }
    public function show(Request $request , $id)
    {
        return $this->faq->show($request , $id);
    }
    public function update(Request $request , $id)
    {
        return $this->faq->update($request , $id) ;
    }

    public function destroy(DestroyRequest $request ,$id)
    {
        return $this->faq->destroy ($request ,$id);
    }
}
