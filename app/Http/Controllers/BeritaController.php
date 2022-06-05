<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Carbon\Carbon;

class BeritaController extends Controller
{
    public function __construct(Database $database){
        $this->database = $database;
        $this->tableName = 'berita';
    }

    public function indexBerita()
    {
        return view('berita.berita');
    }
}
