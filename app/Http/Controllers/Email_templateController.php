<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Email_templateRepository;
use App\Http\Requests\Email_template\StoreRequest ;
use App\Http\Requests\Email_template\EditRequest ;
use App\Http\Requests\Email_template\DestroyRequest ;
use App\Http\Requests\Email_template\ShowRequest ;
use App\Http\Requests\Email_template\IndexRequest ;
class Email_templateController extends Controller
{




        protected $Email_template;


        public function __construct(Email_templateRepository $Email_template)
        {
            $this->Email_template = $Email_template;
        }

        public function index()
        {
        }
        public function create()
        {

        }

        public function store(StoreRequest $request)
        {

        }
        public function show(ShowRequest $request , $type)
        {
            return $this->Email_template->show($request , $type);
        }
        public function update(EditRequest $request , $type)
        {
            return $this->Email_template->update($request ,$type);

        }

        public function destroy(DestroyRequest $request ,$id)
        {
        }
    }


