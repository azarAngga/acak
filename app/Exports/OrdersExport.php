<?php

namespace App\Exports;

use App\Orders;
use App\User;
use App\type_order;
use App\locker;
use App\status_order;
use App\versions;


use Illuminate\Contracts\View\View;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

// class OrdersExport implements FromCollection
class OrdersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Orders::all();
    // }

    private $date1 = "";
    private $date2 = "";
    private $jenis_page = "";

    public function __construct($date1,$date2,$jenis_page)
    {
        $this->date1 = $date1;
        $this->date2  = $date2;
        $this->jenis_page  = $jenis_page;
    }

    public function view(): View
    {
        $m_orders = new orders();
        $m_user = new User();
        $m_type_order = new type_order();
        $m_locker = new locker();
        $m_status_order = new status_order();
        $m_orders = new orders();
        $versions = new versions();
        if($this->date1 == ""){
            if($this->jenis_page == "eksekutor"){
                $data = $m_orders->getEksekutorForExcel();    
            }else{
                $data = $m_orders->getPermintaanForExcel();
            }
        }else{
            if($this->jenis_page == "eksekutor"){
                $data = $m_orders->getEksekutorWithDateForExcel($this->date1,$this->date2);
            }else{
                $data = $m_orders->getPermintaanWithDateForExcel($this->date1,$this->date2);
            }
        }
        
        return view('excel.order', [
            'order' => $data,
            "m_versions"=>$versions,
            "m_user"=>$m_user,
            "m_orders"=>$m_orders,
            "m_type_order"=>$m_type_order,
            "m_locker"=>$m_locker,
            "m_status_order"=>$m_status_order

        ]);
    }
}
