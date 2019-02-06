<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table = 'kategori';

    public function scopeGet($query)
    {
        return $this->get();
    }

    public function scopeGetByid($query, $idKategori)
    {
        return $this
                ->where('id_kategori', $idKategori)
                ->get();
    }
    public function scopeAdd($query, $data)
    {
        return $this->insert($data);
    }
    public function scopeEdit($query, $data, $idKategori)
    {
        return $this
                ->where('id_kategori', $idKategori)
                ->update($data);
    }

    public function scopeRemove($query, $id)
    {
        return $this
                ->where('id_kategori', $id)
                ->delete();
    }

    public function scopeSearch($query, $keyword, $limit)
    {
        return $this
                ->where(
                    'nama_kategori','like',"%$keyword%"
                )
                ->simplePaginate($limit);
    }

}
