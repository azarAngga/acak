<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_order extends Model
{
    //
    protected $table = 'type_order';
    public function getTypeOrder(){ 
        return type_order::select('*')->get();
    }

    public function getTypeOrderById($id){ 
        return type_order::select('*')
        ->where('id_type_order','=',$id)
        ->get();
    }
}
