<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadgeController extends Controller
{
    //
    public function index(){
        return view("students.badge");
    }
    public function store(Request $request){
        
    }
}
