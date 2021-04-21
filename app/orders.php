<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\DateTime;
class orders extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
        'wo',
        'nama_calang',
        'long',
        'lat',
        'nama_odp',
        'alamat',
        'id_categori_order',
        'inputer',
        'create_dtm',
        'last_update',
        'target_selesai',
        'date_other',
        'day_add_other',
        'status'
    ]; 

    // public function getPivotExksekutor($id_eksekutor,$id_status_order){
    //    return orders::select('*')
    //    ->where('id_eksekutor',$id_eksekutor)
    //    ->where('id_status_order',$id_status_order)
    //    ->count();
    // }
    

    public function getEksekutor($id){
        if($id == "1"){
            $param = "id_mitra";
        }else if($id == "2"){

        }else{

        }

       return Orders::select('id_eksekutor')
        ->where('id_eksekutor','!=','')
        ->groupBy('id_eksekutor')
        ->orderBy('id_eksekutor')->get();
    }

    public function getEksekutorForExcel(){
        return Orders::select('*')
         ->where('id_eksekutor','!=','')
         ->orderBy('id_eksekutor')->get();
     }

     public function getLastFormatOther(){
        return Orders::select('*')
         ->where('wo','like','OT%')
         ->orderBy('wo','desc')->get();
     }

    public function getEksekutorWithDate($date1,$date2){
        return  Orders::select('id_eksekutor')
        ->where('id_eksekutor','!=','')
        ->where('open_date','>=',$date1)
        ->where('open_date','<=',$date2)
        ->where('id_eksekutor','!=','')
        ->groupBy('id_eksekutor')
        ->orderBy('id_eksekutor')->get();
    }

    public function getEksekutorWithDateForExcel($date1,$date2){
        return  Orders::select('*')
        ->where('id_eksekutor','!=','')
        ->where('open_date','>=',$date1)
        ->where('open_date','<=',$date2)
        ->orderBy('id_eksekutor')->get();
    }

    // permintaan

    public function getPermintaan(){
       return Orders::select('id_type_order')
        ->where('id_type_order','!=','')
        ->groupBy('id_type_order')
        ->orderBy('id_type_order')->get();
    }

    public function getPivotPermintaan($id_type_order,$id_status_order){
        return orders::select('*')
        ->where('id_type_order',$id_type_order)
        ->where('id_status_order',$id_status_order)
        ->count();
    }

    public function getPermintaanWithDate($date1,$date2){
        return  Orders::select('id_type_order')
        ->where('id_type_order','!=','')
        ->where('open_date','>=',$date1)
        ->where('open_date','<=',$date2)
        ->groupBy('id_type_order')
        ->orderBy('id_type_order')->get();
    }

    public function getPermintaanForExcel(){
        return Orders::select('*')
         ->where('id_type_order','!=','')
         ->orderBy('id_type_order')->get();
    }

    public function getPermintaanWithDateForExcel($date1,$date2){
        return  Orders::select('*')
        ->where('id_type_order','!=','')
        ->where('open_date','>=',$date1)
        ->where('open_date','<=',$date2)
        ->orderBy('id_type_order')->get();
    }
    
    public function getChartLine($jenis_page,$id,$date1,$date2){

        if($jenis_page == "permintaan"){
            $query = ' t.id_type_order = '.$id.' ';
        }else{
            $query = ' t.id_eksekutor = '.$id.' ';
        }

        $with_date = '';
        if($date1 != ""){
            $with_date = ' and date_format(t.close_date, "%Y%m%d") between "'.$date1.'" and "'.$date2.'" ';    
        }
        return  DB::select('SELECT 
        date_format(t.close_date, "%Y") as years,
        date_format(t.close_date, "%m") as month,
        count(if(t.id_status_order=5,1,0)) as close
        FROM orders t
        WHERE
        t.id_status_order=5
        '.$with_date.'
        and
        '.$query.'
        GROUP BY date_format(t.close_date, "%m"),date_format(t.close_date, "%Y")');
    }


    public function convertDate($month){
        $data = array(
            "01"=>"JAN",
            "02"=>"FEB",
            "03"=>"MART",
            "04"=>"APR",
            "05"=>"MEI",
            "06"=>"JUN",
            "07"=>"JUL",
            "08"=>"AGS",
            "09"=>"SEPT",
            "10"=>"OKT",
            "11"=>"NOV",
            "12"=>"DES"
        );

        return $data[$month];
    }


    // p21
    //$design_tiket = $m_orders->table(1,1,1,null,null); 
    public function table($id,$id_locker,$id_mitra,$param,$wo){
        //$order = $m_orders->table($id,$id_locker,$id_mitra);
        $status = array();
        if($id == "1"){
            $status = array(0,11);
        }else if($id == "2"){
            // $status = array(11,8);
            $status = array(8);
        }else if($id == "3"){
            $status = array(2,12,21);
        }else if($id == "4"){
            $status = array(4);
        }else if($id == "5"){
            $status = array(3,9,14);
        }else if($id == "6"){
            $status = array(5,10,13);
        }else if($id == "7"){
            $status = array(7,18,19);
        }
        if($id_locker != "3"){
            $data = DB::table('orders')
            ->join('kategori_order', 'orders.id_categori_order', '=', 'kategori_order.id_kategori_order')
            ->select('orders.*','kategori_order.deskripsi')
            ->whereIn('orders.status', $status);
            if($param != null){
                $data->where("order.$parameter",$wo);
            }
            $data = $data->orderBy("orders.id","asc")
            ->get();
        }else{
            $data = DB::table('orders')
            ->join('kategori_order', 'orders.id_categori_order', '=', 'kategori_order.id_kategori_order')
            ->select('orders.*','kategori_order.deskripsi')
            ->whereIn('orders.status', $status)
            ->where('id_mitra',$id_mitra);
            if($param != null){
                $data->where("order.$parameter",$wo);
            }
           $data = $data->orderBy("orders.id","asc")
            ->get();

        }
            return $data;
    }

    
    public function getLabel($id){
        $label = "";
        if($id == "1"){
            $label = "DESIGN";
        }else if($id == "2"){
            $label = "ASSIGN MITRA";
        }else if($id == "3"){
            $label = "KONSTRUKSI";
        }else if($id == "4"){
            $label = "GO LIVE";
        }else if($id == "5"){
            $label = "PENDING";
        }else if($id == "6"){
            $label = "CANCEL";
        }else if($id == "7"){
            $label = "CLOSE";
        }else{
            $label = "";
        }
        return $label;
    }
    
    // p21
    public function tableSearch($wo,$param){

            $data = DB::table('orders')
            ->join('kategori_order', 'orders.id_categori_order', '=', 'kategori_order.id_kategori_order')
            ->select('orders.*','kategori_order.deskripsi')
            ->where($param,"like","%$wo%")
            ->orderBy("orders.id","asc")
            ->get();
            return $data;
    }
    

    //p21
    public function getMitra($id){
        if($id == "1"){
            $param = "id_mitra";
        }else if($id == "2"){

        }else{

        }

       return mitra::select('*')->get();
    }

    public function getPivotMitra($id_mitra,$id_status_order){
       return orders::select('*')
       ->where('id_mitra',$id_mitra)
       ->where('status',$id_status_order)
       ->count();
    }

    public function getAverage($id_mitra,$id_status_order){
        $order_mitra = orders::select('*')
       ->where('id_mitra',$id_mitra)
       ->count();

       $order_sesuai_status = orders::select('*')
       ->where('id_mitra',$id_mitra)
       ->where('status',$id_status_order)
       ->count();

       if($order_sesuai_status != 0 && $order_mitra != 0 ){
        return ($order_sesuai_status/$order_mitra) * 100;
       }else{
         return 0;
       }
        
       
    }

    



}
