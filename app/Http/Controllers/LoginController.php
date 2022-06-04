<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function indexLogin()
    {
        return view('login.login');
    }

    public function buatSession(Request $request) {

        $this->validate($request,[
            'username' => 'required',
            'password' => 'required',
         ]);  

        $data = $request->input();
        $username = $data['username'];
        $password = $data['password'];
        if($username == "admin" && $password == "admin") {
            $request->session()->put('username', $data['username']);
            return redirect('/');
        } else{
            return redirect('/login');
        }
	}

   
    
    
}
