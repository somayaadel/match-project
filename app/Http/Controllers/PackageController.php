<?php

namespace App\Http\Controllers;

use App\Http\Requests\Package\CreateRequest;
use App\Http\Requests\Package\DestroyRequest;
use App\Http\Requests\Package\EditRequest;
use App\Http\Requests\Package\IndexRequest;
use App\Http\Requests\Package\ShowRequest;
use App\Http\Requests\Package\StoreRequest;
use App\Repositories\PackageRepository;

class packageController extends Controller
{

    protected $Package;

    public function __construct(PackageRepository $Package)
    {
        $this->Package = $Package;
    }

    public function index(IndexRequest $request)
    {
        return $this->Package->all();
    }
    public function create(CreateRequest $request)
    {
        return $this->Package->create($request);
    }
    public function store(StoreRequest $request)
    {
        return $this->Package->store($request);
    }

    public function show(ShowRequest $request, $id)
    {
        return $this->Package->show($request, $id);
    }

    public function update(EditRequest $request, $id)
    {
        return $this->Package->update($request, $id);
    }

    public function destroy(DestroyRequest $request, $id)
    {
        return $this->Package->destroy($request, $id);
    }
}
