<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kategory_order extends Model
{
    //
    protected $table = 'kategori_order';
    public function allKategori(){ 
        return kategory_order::select('*')->get();
    }

    public function KategoriById($id){ 
        return kategory_order::select('*')
        ->where('id_kategori_order',$id)
        ->get();
    }
}
