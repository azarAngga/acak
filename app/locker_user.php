<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_user extends Model
{
    //
    protected $table = 'type_user';

    public function getDeskripsi($id){

        return type_user::select('*')->where('id_type',$id)->get()[0]->deskripsi;
    }
    
}
