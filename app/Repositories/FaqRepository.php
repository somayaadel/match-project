<?php
namespace App\Repositories;
use Illuminate\Http\Request;


use App\Models\Faq;


class FaqRepository
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function create()
    {
        $Service =  Service::all();
        return response()->json(['data' =>  $Service]) ;
    }

    public function store(Request $request)
    {
        foreach($request->all() as $question){
            if($question['id'] == null){

                $Faq = new Faq ;
                $Faq->fill($question) ;
                $Faq->save() ;
            }
            else if($question['id']){
                $Faq= Faq::findOrFail($question['id']);
                $Faq->update($question);
            }
        }
        return response()->json(['data' => $Faq]) ;
    }


    public function show(Request $request , $FaqId)
    {
        $Faq = Faq::findOrFail($FaqId);
        return response()->json(['data'=>$Faq]) ;
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {

        $Faqs =  Faq::all();
        return response()->json(['data' => $Faqs]) ;
    }

    public function update(Request $request , $FaqId )
    {
        $Faq=Faq::findOrFail($FaqId);
        $Faq->update($request->all());
        $Faq->save() ;
        return response()->json(['data' => $Faq]) ;
    }

    public function destroy(Request $request ,$FaqId)
    {
        return DestroyRepository::destroy(Faq::class ,$FaqId );
    }
}
