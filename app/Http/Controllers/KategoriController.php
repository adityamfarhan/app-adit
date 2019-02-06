<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
    //
    public function index()
    {
        $data = Kategori::paginate(5);
        return view('kategori.index', [
            'kategori' => $data
        ]);
    }

    public function byId($idKategori)
    {
        $data = Kategori::getById($idKategori);
        return json_encode($data);
    }

    //crud
    public function publish(Request $request)
    {
        $title = $request['nama-kategori'];

        $rest = Kategori::Add(['nama_kategori' => $title]);

        if ($rest)
        {
            return redirect(route('kategori-index'));
        }
        else
        {
           return redirect(route('errors/404'));
        }
    }
    public function put(Request $request)
    {
        $idKategori = $request['id-kategori'];
        $namaKategori = $request['nama-kategori'];
        $data = [
            'nama_kategori' => $namaKategori
        ];
        $rest = Kategori::Edit($data, $idKategori);
        if ($rest)
        {
            return redirect(route('kategori-index'));
        }
        else
        {
            return redirect(route('errors/404'));
        }
    }
    public function remove(Request $request)
    {
        $id = $request['id-kategori-remove'];
        $rest = Kategori::Remove($id);
        if ($rest)
        {
            return redirect(route('kategori-index'));
        }
        else
        {
            return redirect('remove not found');
        }
    }
    public function search()
    {
        $keyword = $_GET['keyword'];
        $data = Kategori::Search($keyword, 5);
        return view('kategori.index', [
            'kategori' => $data
        ]);
    }

}
