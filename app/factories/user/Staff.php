<?php
namespace App\factories\user ;
use App\Interfaces\userInterface ;
use App\Models\User ;
use Illuminate\Http\Request;

class Staff implements  userInterface{
    public function index(){
    }
    public static function show(Request $request , $id){
        return User::with('userData')->findOrFail($id) ;
    }
}
