<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mitra extends Model
{
    //
    protected $table ="mitra";

    protected $fillable = [
        'nama_mitra','alamat','id_mitra'
    ];

    static function getNotInMitra($id){
        return mitra::select('*')
        ->where('id_mitra','!=',$id)
        ->get();
    }
    
    public function getMitra($id){
        return mitra::select('*')
        ->where('id_mitra','=',$id)
        ->get();
    }
}
