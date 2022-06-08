<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;
use Carbon\Carbon;
use Google\Cloud\Firestore\FirestoreClient; 
use Kreait\Firebase\Contract\Storage;
use Google\Cloud\Storage\StorageClient;
class BeritaController extends Controller
{
    public function __construct(Database $database, Storage $storage){
        $this->database = $database;
        $this->tableName = 'berita';
        $this->storage = $storage;

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

    public function tambahBerita(Request $request){ 
        
        dd($request);
        $created_at = Carbon::today()->toDateString();
 
        $pos_data = [ 
            'image' => $image,
            'judul' => $request->judul,
            'link' => $request->link,
            'desc' => $request->desc,
            'tanggal_buat' => $created_at,

        ];
        
        $post_ref = $this->database->getReference($this->tableName)->push($pos_data);
        if($post_ref->getKey() != null){
            return redirect('/berita')->with('success', 'Data Berhasil Ditambahkan');  
        }else{
            return redirect('/berita')->with('error', 'Data Gagal Ditambahkan');  
        }
        
        
    }

   
}
