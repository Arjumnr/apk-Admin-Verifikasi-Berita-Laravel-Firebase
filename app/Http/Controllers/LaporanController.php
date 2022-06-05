<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class LaporanController extends Controller
{
    public function __construct(Database $database){
        $this->database = $database;
        $this->tableName = 'Laporan';
    }

    public function indexLaporan()
    {
        $laporan = $this->database->getReference('Laporan')->getValue();
        if($laporan == null){
            $laporan = [];
        }
        return view('laporan.laporan' , compact('laporan'));
       
    }

    public function cekLaporan(Request $request, $id){
        $key = $id;
        $input = [];
        $input['status']=$request->cekLaporan;
       
        $res_update_date = $this->database->getReference($this->tableName)->getChild($key)->update($input);
        if($res_update_date){
            return redirect('/laporan');
        }
    }

   
}
