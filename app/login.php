<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class login extends Model
{
    
    public function get_user(){
        $db = User::all();
        return $db;
    }

    static public function checkUserLogin(){
        $user = User::where('username','1')->get();
        return $user;
    }
    
     
    
}
