<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('auth.signin',[
            'title' => 'Masuk'
        ]);
    }

    public function auth(Request $request){
        
    }
}
