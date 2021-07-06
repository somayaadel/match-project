<?php
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\EmailTemplate ;


class Email_templateRepository
{


    public function all()
    {

    }

    public function store(Request $request)
    {



    }

    public function update( Request $request , $type)
    {
        $Email_template = EmailTemplate::where('type',$request['type'])->first();


        $Email_template->update($request->all());
        return response()->json(['data' => $Email_template]) ;
    }

    public function show(Request $request,$type){


        $Email_template = EmailTemplate::where('type',$request['type'])->first() ;
        return response()->json(['data'=>$Email_template]) ;
    }



    public function destroy(Request $request ,$Email_templateId){
    }
}
