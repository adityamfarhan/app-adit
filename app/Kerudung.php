<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kerudung extends Model
{
    //
    protected $table = 'kerudung';

    public function scopeGet($query)
    {
        return $this->get();
    }

    public function scopeGetByid($query, $id)
    {
        return $this
                ->join('users', 'users.id', '=', 'kerudung.id')
                ->where('id_kerudung', $id)
                ->get();
    }

    public function scopeGetByKategori($query, $idKategori)
    {
        return $this
                ->where('id_kategori', $idKategori)
                ->get();
    }

    public function scopeAdd($query, $data)
    {
        return $this->insert($data);
    }

    public function scopeEdit($query, $data, $id)
    {
        return $this
                ->where('id_kerudung', $id)
                ->update($data);
    }

    public function scopeRemove($query, $id)
    {
        return $this
                ->where('id_kerudung', $id)
                ->delete();
    }

    public function scopeSearch($query, $keyword, $limit)
    {
        return $this
                ->where(
                    'nama_kerudung','like',"%$keyword%"
                )
                ->orWhere(
                    'ukuran','like',"%$keyword%"
                )
                ->orWhere(
                    'warna','like',"%$keyword%"
                )
                ->simplePaginate($limit);
    }



}
