<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        $session = $request->session()->has('username');
        
        if($session == true){
            return view('dashboard');
        } else {
            return redirect('/login');
        }
        return view('dashboard');
    }
    

    public function logout(Request $request) {
        $request->session()->forget('username');
        return redirect('/login');
    }

   
    
}
