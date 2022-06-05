<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class BeritaController extends Controller
{
    public function __construct(Database $database){
        $this->database = $database;
        $this->tableName = 'berita';
    }

    public function indexBerita()
    {
        $berita = $this->database->getReference('berita')->getValue();
        if($berita == null){
            $berita = [];
        }
        return view('berita.berita' , compact('berita'));
       
    }

    public function cekBerita(Request $request, $id){
        $key = $id;
        $input = [];
        $input['status']=$request->cekBerita;
       
        $res_update_date = $this->database->getReference($this->tableName)->getChild($key)->update($input);
        if($res_update_date){
            return redirect('/berita');
        }
    }

   
}
