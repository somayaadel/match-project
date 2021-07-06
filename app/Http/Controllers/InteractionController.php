<?php

namespace App\Http\Controllers;

use App\Repositories\InteractionRepository;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    //
    protected $InteractionRepository;

    public function __construct(InteractionRepository $InteractionRepository)
    {
        $this->InteractionRepository = $InteractionRepository;
    }
    public function index(Request $request, $company_id)
    {
        return $this->InteractionRepository->all($request, $company_id);
    }
    public function seen(Request $request, $interaction_id)
    {
        return $this->InteractionRepository->seen($request, $interaction_id);
    }
    public function filterCreate()
    {
        return $this->InteractionRepository->filterCreate();
    }
    public function filterUsers(Request $request, $company_id)
    {
        return $this->InteractionRepository->filterUsers($request, $company_id);
    }
}
