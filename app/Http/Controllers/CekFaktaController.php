<?php

namespace App\Http\Controllers;
use Kreait\Firebase\Contract\Database;
use Illuminate\Http\Request;

class CekFaktaController extends Controller
{

    public function __construct(Database $database){
        $this->database = $database;
        $this->tableName = 'Cek Fakta';
    }

    public function indexCekFakta()
    {
        $cek_fakta = $this->database->getReference('Cek Fakta')->getValue();
        
        if($cek_fakta == null){
            $cek_fakta = [];
        }
        return view('cek_fakta.cek_fakta', compact('cek_fakta'));

    }

    public function cekFakta(Request $request, $id){
        $key = $id;
        $input = [];
        $input['status']=$request->cekFakta;
       
        $res_update_date = $this->database->getReference($this->tableName)->getChild($key)->update($input);
        if($res_update_date){
            return redirect('/cekFakta');
        }
    }
}
