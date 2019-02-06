<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;
use App\Kerudung;
use App\Kategori;
use Auth;

class KerudungController extends Controller
{
    //
    public function index()
    {
        $data = Kerudung::paginate(5);
        $kt = Kategori::get();
        return view('kerudung.index', [
            'kerudung' => $data,
            'kategori' => $kt
        ]);
    }

    public function byId($idKerudung)
    {
        $data = Kerudung::GetById($idKerudung);
        return json_encode($data);
    }

    public function byKategori($idKategori)
    {
        $data = Kerudung::GetByProject($idKategori);
        return json_encode($data);
    }

    public function publish(Request $request)
    {
        $namaKerudung = $request['nama-kerudung'];
        $ukuran = $request['ukuran'];
        $harga = $request['harga'];
        $warna = $request['warna'];
        $gambar = $request->file('gambar');
        $id_kategori = $request['id-kategori'];
        $id = Auth::id();


        if ($request->hasFile('gambar')) {
    		//setting foto profile
	    	$this->validate($request, [
	    		'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
	    	]);
    		$image = $request->file('gambar');
    		$chrc = array('[',']','@',' ','+','-','#','*','<','>','_','(',')',';',',','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
		    $filename = $id.time().str_replace($chrc, '', $image->getClientOriginalName());
		    //create thumbnail
		    $destination = public_path('img/gallery/thumbnails/'.$filename);
		    $img = Image::make($image->getRealPath());
		    $img->resize(200, 200, function ($constraint) {
		    	$constraint->aspectRatio();
		    })->save($destination);
		    //create image real
		    $destination = public_path('img/gallery/covers/');
		    $image->move($destination, $filename);
		    //set array data
		    $data = array(
		    	'nama_kerudung' => $namaKerudung,
                'ukuran' => $ukuran,
                'harga' => $harga,
                'warna' => $warna,
                'gambar' => $filename,
                'id' => $id,
                'id_kategori' => $id_kategori

		    );
    	} else {
    		//set array data
            $data = array (
                'nama_kerudung' => $namaKerudung,
                'ukuran' => $ukuran,
                'harga' => $harga,
                'warna' => $warna,
                'gambar' => $filename,
                'id' => $id,
                'id_kategori' => $id_kategori
            );
    	}
        $rest = Kerudung::Insert($data);

        if ($rest) {
            return redirect(route('kerudung-index'));
        } else {
            echo 'Error';
        }

    }

    public function put(Request $request){
        $namaKerudung = $request['nama-kerudung'];
        $ukuran = $request['ukuran'];
        $harga = $request['harga'];
        $warna = $request['warna'];
        $gambar = $request->file('gambar');
        $id_kategori = $request['id-kategori'];
        $id = Auth::id();


        if ($request->hasFile('gambar')) {
    		//setting foto profile
	    	$this->validate($request, [
	    		'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
	    	]);
    		$image = $request->file('gambar');
    		$chrc = array('[',']','@',' ','+','-','#','*','<','>','_','(',')',';',',','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
		    $filename = $id.time().str_replace($chrc, '', $image->getClientOriginalName());
		    //create thumbnail
		    $destination = public_path('img/gallery/thumbnails/'.$filename);
		    $img = Image::make($image->getRealPath());
		    $img->resize(200, 200, function ($constraint) {
		    	$constraint->aspectRatio();
		    })->save($destination);
		    //create image real
		    $destination = public_path('img/gallery/covers/');
		    $image->move($destination, $filename);
		    //set array data
		    $data = array(
		    	'nama_kerudung' => $namaKerudung,
                'ukuran' => $ukuran,
                'harga' => $harga,
                'warna' => $warna,
                'gambar' => $filename,
                'id' => $id,
                'id_kategori' => $id_kategori

		    );
    	} else {
    		//set array data
            $data = array (
                'nama_kerudung' => $namaKerudung,
                'ukuran' => $ukuran,
                'harga' => $harga,
                'warna' => $warna,
                'gambar' => $filename,
                'id' => $id,
                'id_kategori' => $id_kategori
            );
    	}
        $rest = Kerudung::Edit($data);

        if ($rest) {
            return redirect(route('kerudung-index'));
        } else {
            echo 'Error';
        }
    }

    public function remove(Request $request)
    {
        $id = $request['id-kerudung-remove'];
        $rest = Kerudung::Remove($id);
        if ($rest) {
            return redirect(route('kerudung-index'));
        } else {
            return 'Error';
        }

    }

    public function search()
    {
        $keyword = $_GET['keyword'];
        $data = Kerudung::Search($keyword, 5);
        return view('kerudung.index', [
            'kerudung' => $data
        ]);
    }



}
