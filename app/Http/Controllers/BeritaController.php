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

        $request->validate([
            
            'image' => 'required | image | mimes:jpeg,png,jpg,gif,svg ',
        ]);
        $image = $request->image;
        $fileName = $image->getClientOriginalName();
        
        $gambarBerita = app('firebase.firestore')->database()->collection('Images')->document($fileName); 
        $firebase_storage_path = 'gambarBerita/';
        $name = $gambarBerita->id();
        $local_folder = public_path('firebase-temp-uploads') .'/';
        $extension = $image->getClientOriginalExtension();
        $file = $name;
        $fixMove = $image->move($local_folder, $file);
        if($fixMove){
           $uploadedfile = fopen($local_folder . $file, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, [
            'name' => $firebase_storage_path . $file,
            'metadata' => [
                'contentType' => $image->getClientMimeType(),
                'cacheControl' => 'public, max-age=31536000',
            ],
            ]);

            
            // link($local_folder . $file);
        }
        
        $downloadUrl = app('firebase.storage')->getBucket()->object($firebase_storage_path . $file)->signedUrl(Carbon::now()->addMinutes(5));

        $created_at = Carbon::today()->toDateString();
 
        $pos_data = [ 
            'image' => $downloadUrl,
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

    public function deleteBerita($id){
        $delete_berita = $this->database->getReference($this->tableName)->getChild($id)->remove();
        if($delete_berita){
            return redirect('/berita')->with('success', 'Data Berhasil Dihapus');
        }else{
            return redirect('/berita')->with('error', 'Data Gagal Dihapus');
        }
    }

    public function editBerita($id){
        
        $key = $id;
        $edit_data = $this->database->getReference($this->tableName)->getChild($key)->getValue();
        if($edit_data){
            return view('berita.edit-berita', compact('edit_data' , 'key'));
        }else{
            return redirect()->route('indexBerita');
        }
        return view('berita.editBerita' , compact('berita'));
    }

    public function update(Request $request, $id){
        dd($request->all());
        $key = $id;
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required | image | mimes:jpeg,png,jpg,gif,svg ',
            ]);
            $image = $request->image;
            $fileName = $image->getClientOriginalName();
            
            $gambarBerita = app('firebase.firestore')->database()->collection('Images')->document($fileName); 
            $firebase_storage_path = 'gambarBerita/';
            $name = $gambarBerita->id();
            $local_folder = public_path('firebase-temp-uploads') .'/';
            $extension = $image->getClientOriginalExtension();
            $file = $name;
            $fixMove = $image->move($local_folder, $file);
            if($fixMove){
               $uploadedfile = fopen($local_folder . $file, 'r');
                app('firebase.storage')->getBucket()->upload($uploadedfile, [
                'name' => $firebase_storage_path . $file,
                'metadata' => [
                    'contentType' => $image->getClientMimeType(),
                    'cacheControl' => 'public, max-age=31536000',
                ],
                ]);

                
                // link($local_folder . $file);
            }
            $downloadUrl = app('firebase.storage')->getBucket()->object($firebase_storage_path . $file)->signedUrl(Carbon::now()->addMinutes(5));

            $created_at = Carbon::today()->toDateString();
     
            $update_data = [ 
                'image' => $downloadUrl,
                'judul' => $request->judul,
                'link' => $request->link,
                'desc' => $request->desc,
                'tanggal_buat' => $created_at,
    
            ];
            $res_update_date = $this->database->getReference($this->tableName)->getChild($key)->set($update_data);
                if($res_update_date){
                    return redirect()->route('indexBerita')->with('success', 'Data Berhasil Diupdate');
                }else{
                    return redirect()->route('indexBerita')->with('error', 'Data Gagal Diupdate');
                }

        }else{

            $created_at = Carbon::today()->toDateString();
     
            $update_data = [ 
                'image' => $request->image,
                'judul' => $request->judul,
                'link' => $request->link,
                'desc' => $request->desc,
                'tanggal_buat' => $created_at,
    
            ];
            $res_update_date = $this->database->getReference($this->tableName)->getChild($key)->set($update_data);
                if($res_update_date){
                    return redirect()->route('indexBerita')->with('success', 'Data Berhasil Diupdate');
                }else{
                    return redirect()->route('indexBerita')->with('error', 'Data Gagal Diupdate');
                }

        }
            
                      
            
        

    }

   
}