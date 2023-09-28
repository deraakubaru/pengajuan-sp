<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImagePengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $file = ImagePengumuman::paginate(4);
    return view('file.index',compact('file'));
}

public function create() //menampilkan form secara partial
{
    $file = new ImagePengumuman;
    return view('file.create',compact('file'))->renderSections()['content'];
}

public function store(Request $request)
{
   $maxId = \DB::table('image')->max('id') + 1;
   try{       
       $uploaded = $request->file('file');
       $file = new ImagePengumuman;
       $file->id = $maxId;
       $file->nama = $request->nama;
       $file->file = $maxId."-".$uploaded->getClientOriginalName();
       $file->save();

       $uploaded->move(public_path('images/'),$file->file); //Folder lokasi File
       \Session::flash('flash_message','Gambar berhasil ditambahkan');
   }catch(\Exception $e){
        echo $e->getMessage();
        echo "<br>".$e->getLine();
        die();
   }

    $response = array(
         'status' => 'success',
         'url' => action('ImagePengumumanController@index'),
    );
    return $response;
 }

public function destroy($id)
{
     $file = ImagePengumuman::findOrFail($id);
     unlink(public_path('images/').$file->file); //menghapus dokumen pada folder terkait
     $file->delete();

     \Session::flash('flash_message','Dokumen berhasil di hapus');
     return redirect()->action('ImagePengumumanController@index');
}
}
