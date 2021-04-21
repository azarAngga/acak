<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attach_file extends Model
{
    //
    protected $table = "attach_file";
    public function getFile($id,$type,$status){
        return attach_file::select('*')
        ->where('id_order',$id)
        ->where('type_file',$type)
        ->where('status',$status)
        ->get();   
    }

  

}
