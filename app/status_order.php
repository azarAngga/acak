<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class status_order extends Model
{
    //
    protected $table = 'status_order';
    public function getStatusOrderFromId($id){ 
        return status_order::select('*')->where('id_status_order',"=",$id)->get()[0]['alias'];

    }

    public static function MenuInbox(){
        return array("1","3","6","4","5");
    }

    public static function StatusOrder(){
        return status_order::select('*')->get();
    }
}
