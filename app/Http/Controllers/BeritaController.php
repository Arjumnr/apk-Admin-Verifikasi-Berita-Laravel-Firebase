<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function indexBerita()
    {
        return view('berita.berita');
    }
}
