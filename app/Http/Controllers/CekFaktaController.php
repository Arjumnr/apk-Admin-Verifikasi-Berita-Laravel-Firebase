<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekFaktaController extends Controller
{
    public function indexCekFakta()
    {
        return view('cek_fakta.cek_fakta');
    }
}
