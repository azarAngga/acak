<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class versions extends Model
{
    //

    public function getData(){
        return versions::select('*')->get()[0]['no'];
        
    }

    public function UpdateData(){
        $data = versions::select('*')->get()[0]['no'];
        $data_origin = $data;
        $data = intval($data) + 1;
        versions::where('no', $data_origin)
        ->update(
            [
                'no' => $data
            ]
      );


        return $data;
    }
}
