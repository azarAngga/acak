<?php

namespace App\Http\Controllers;

use App\orders;
use App\User;
use App\type_order;
use App\locker;
use App\status_order;
use App\versions;
use App\kategory_order;
use App\mitra;
use App\attach_file;

use Session;

use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function inboxOrder($id,Request $r)
    {
        
        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();
        $m_kategory_order = new kategory_order();
        $m_attach_file = new attach_file();
        $m_mitra = new mitra();

        $id_user = $r->session()->get("id_user");

        $users = User::select('*')
        ->where("id_user","=",$id_user)
        ->get();

        $id_locker = $users[0]->id_role_user;
        $id_mitra = $users[0]->id_mitra;
        $mitra = mitra::select('*')
        ->get();

        $label = $m_orders->getLabel($id);
        
        $order = $m_orders->table($id,$id_locker,$id_mitra,null,null);

        return view('inbox.table',  
        [
            "label"=>$label,
            "data"=>$order,
            "m_user"=>$m_user,
            "m_attach_file"=>$m_attach_file,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_kategory_order"=>$m_kategory_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order,
            "jenis_halaman"=>$id,
            "mitra"=>$mitra,
            "m_mitra"=>$m_mitra,
            "id_user"=>$id_user

        ]);
    }

  

    public function inboxOrderSearch(Request $r)
    {
        //parameter 
        $parameter = $r->param;
        $wo = $r->wo;
           
        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();
        $m_kategory_order = new kategory_order();
        $m_attach_file = new attach_file();
        $m_mitra = new mitra();

        $id_user = $r->session()->get("id_user");

        $users = User::select('*')
        ->where("id_user","=",$id_user)
        ->get();

        $id_locker = $users[0]->id_role_user;
        $id_mitra = $users[0]->id_mitra;
        $mitra = mitra::select('*')
        ->get();

        $label = "Search";
            
        $order = $m_orders->tableSearch($wo,$parameter);
     
      
        return view('inbox.table',
        [
            "label"=>$label,
            "param"=>$parameter,
            "wo"=>$wo,
            "data"=>$order,
            "m_user"=>$m_user,
            "m_attach_file"=>$m_attach_file,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_kategory_order"=>$m_kategory_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order,
            "jenis_halaman"=>"search",
            "mitra"=>$mitra,
            "m_mitra"=>$m_mitra,
            "id_user"=>$id_user

        ]);
    }


    public function report($id)
    {

        // echo $_SERVER['PHP_SELF'];
        $ar_url = explode("/",$_SERVER['PHP_SELF']);
        $ar_count = count($ar_url);
        $jenis_page = $ar_url[($ar_count)-1];

        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();

        $order = $m_orders->getEksekutor();
        
        return view('report.pivote',
        [
            "data"=>$order,
            "m_versions"=>$versions,
            "m_user"=>$m_user,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order,
            "jenis_page"=>$jenis_page,
            "date1"=>"",
            "date2"=>""
        ]);
    }

    public function reportWithDate($tanggal1,$tanggal2)
    {

        $ar_url = explode("/",$_SERVER['PHP_SELF']);
        $ar_count = count($ar_url);
        $jenis_page = $ar_url[($ar_count)-3];

        $date1 = $tanggal1;
        $date2 = $tanggal2;
        
        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();

        if($jenis_page == "eksekutor"){
            $order = $m_orders->getEksekutorWithDate($date1,$date2);
        }else{
            $order = $m_orders->getPermintaanWithDate($date1,$date2);
        }
      
        return view('report.pivote',
        [
            "data"=>$order,
            "m_versions"=>$versions,
            "m_user"=>$m_user,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order,
            "jenis_page"=>$jenis_page,
            "date1"=>$date1,
            "date2"=>$date2

        ]);
    }

    public function inbox($id)
    {
        
        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();


        $id_user = Session::get('id_user');

        $users = User::select('*')
        ->where("id_user","=",$id_user)
        ->get();

        $id_locker = $users[0]->id_locker;
        if($id_locker == "1"){
            $order = Orders::select('*')
            ->where("id_status_order","=",$id)
            ->orderBy('id_status_order')->get();
        }else if($id_locker == "2"){
            $order = Orders::select('*')
            ->where("id_status_order","=",$id)
            ->whereIn('id_type_order', array(2, 3))->get();
        }else if($id_locker == "3"){
            $order = Orders::select('*')
            ->where("id_status_order","=",$id)
            ->whereIn('id_type_order', array(1))->get();
        }

        $label = status_order::where('id_status_order',$id)->get()[0]['deskripsi'];

        return view('inbox',
        [
            "data"=>$order,
            "m_versions"=>$versions,
            "m_user"=>$m_user,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order,
            "label"=>$label,
            "id_user"=>$id_user

        ]);
    }

    public function line(Request $r)
    {

        // echo $_SERVER['PHP_SELF'];
        $ar_url = explode("/",$_SERVER['PHP_SELF']);
        $ar_count = count($ar_url);
        $jenis_page = $ar_url[($ar_count)-1];

        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();

        if($jenis_page == "eksekutor"){
            $order = $m_orders->getEksekutor();
        }else{
            $order = $m_orders->getPermintaan();
        }
       
        return view('grafik.line',
        [
            "data"=>$order,
            "m_versions"=>$versions,
            "m_user"=>$m_user,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order,
            "jenis_page"=>$jenis_page,
            "date1"=>"",
            "date2"=>""
        ]);
    }

    public function lineWithDate($tanggal1,$tanggal2)
    {

        $ar_url = explode("/",$_SERVER['PHP_SELF']);
        $ar_count = count($ar_url);
        $jenis_page = $ar_url[($ar_count)-3];

        $date1 = $tanggal1;
        $date2 = $tanggal2;
        
        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();

        if($jenis_page == "eksekutor"){
            $order = $m_orders->getEksekutor();
        }else{
            $order = $m_orders->getPermintaan();
        }
       
        return view('grafik.line',
        [
            "data"=>$order,
            "m_versions"=>$versions,
            "m_user"=>$m_user,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order,
            "jenis_page"=>$jenis_page,
            "date1"=>$tanggal1,
            "date2"=>$tanggal2
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(orders $orders)
    {
        //
    }

    public function export() 
    {
        $ar_url = explode("/",$_SERVER['PHP_SELF']);
        $ar_count = count($ar_url);
        $jenis_page = $ar_url[($ar_count)-1];
        if($jenis_page == "eksekutor"){
            $name = "eksekutor.xlsx";
        }else{
            $name = "permintaan.xlsx";
        }
        return Excel::download(new OrdersExport("","",$jenis_page), $name);
        
    }

    public function exportWithDate($date1,$date2) 
    {
        $ar_url = explode("/",$_SERVER['PHP_SELF']);
        $ar_count = count($ar_url);
        $jenis_page = $ar_url[($ar_count)-3];
        if($jenis_page == "eksekutor"){
            $name = "eksekutor.xlsx";
        }else{
            $name = "permintaan.xlsx";
        }
        return Excel::download(new OrdersExport($date1,$date2,$jenis_page), $name);
    }
    
    public function chart() 
    {
        $ar_url = explode("/",$_SERVER['PHP_SELF']);
        $ar_count = count($ar_url);
        $jenis_page = $ar_url[($ar_count)-3];

        return view('grafik.report');
    }

    ///p21
    public function getInputer(){

        $m_kategory_order = new kategory_order();
        $m_type_order = new type_order();
        $data_category = $m_kategory_order->allKategori();
        $data_type_order = $m_type_order->getTypeOrder();
        return view('input.inputer',[
            "m_kategory_order"=>$data_category,
            "data_type_order"=>$data_type_order
            ]);
    }

    public function TableMitra(){
        // $m_mitra = new mitra();
        $data = mitra::select('*')->get();
       
        return view('mitra.table',['data'=>$data]);
        // return view('user.table_user',['data'=>$user]);
    }

    public function reportMitra($id)
    {

        // echo $_SERVER['PHP_SELF'];
        $ar_url = explode("/",$_SERVER['PHP_SELF']);
        $ar_count = count($ar_url);
        $jenis_page = $ar_url[($ar_count)-1];

        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();

        $order = $m_orders->getMitra($jenis_page);
        
        return view('report.pivote',
        [
            "data"=>$order,
            "m_versions"=>$versions,
            "m_user"=>$m_user,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order,
            "jenis_page"=>$jenis_page,
            "date1"=>"",
            "date2"=>""
        ]);
    }
}

