<?php

namespace App\Http\Controllers;
use App\Repositories\ContactMessageRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ContactMessage\StoreRequest ; 
use App\Http\Requests\ContactMessage\EditRequest ; 
use App\Http\Requests\ContactMessage\DestroyRequest ; 
use App\Http\Requests\ContactMessage\ShowRequest ; 
use App\Http\Requests\ContactMessage\IndexRequest ; 


class ContactMessageController extends Controller
{
    protected $contactMessage;
    public function __construct(ContactMessageRepository $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }
    public function index(IndexRequest $request)
    {
        return  $this->contactMessage->all();
    }
    public function store(StoreRequest $request)
    {
        return $this->contactMessage->store($request) ;    
    }
    public function show(ShowRequest $request , $id)
    {
        return $this->contactMessage->show($id);
    }
    public function update(EditRequest $request , $id)
    {
        return $this->contactMessage->update($request , $id) ; 
    }
    public function destroy(DestroyRequest $request , $application_id)
    {   
        return $this->contactMessage->destroy($request , $application_id) ; 
    }
}
