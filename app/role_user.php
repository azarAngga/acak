<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role_user extends Model
{
    //
    protected $table = 'role_user';

    public function getDeskripsi($id){

        return role_user::select('*')->where('id_role',$id)->get()[0]->deskripsi;
    }
    
}
