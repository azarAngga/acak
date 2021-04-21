<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class locker extends Model
{
    //
     //
     protected $table = 'locker';
     public function getLockerFromId($id){ 
         return locker::select('*')->where('id_locker',"=",$id)->get()[0]['deskripsi'];
     }
}
