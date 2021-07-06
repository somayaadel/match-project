<?php 
namespace App\Interfaces;
use Illuminate\Http\Request;

interface userInterface{
    public function index() ; 
    public static function show(Request $request , $id) ; 

}