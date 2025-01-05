<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function login(){
        return view('tenant.auth.login');
    }

    public function loginStore(Request $request){
       dd($request->all());
    }

    public function register(){
        return view('tenant.auth.login');
    }

    public function registerStore(Request $request){
       dd($request->all());
    }
    public function logout(Request $request){
        dd($request->all());
     }
}
