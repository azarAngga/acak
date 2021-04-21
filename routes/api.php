<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\WebsocketDemoEvent;

use App\User;
use App\orders;
use App\status_order;
use App\TelegramStorage;
use App\UserFu;
use App\locker;
use App\versions;
use App\role_user;
use App\mitra;
use App\kategory_order;
use App\type_order;

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('update', function (Request $r){
    // broadcast(new WebsocketDemoEvent('somedata'));
    // $varsion = new versions();
    // return $varsion->UpdateData();
});

Route::get('get_versions', function (){
    $version = new versions();
    $data = $version->getData();

    return $data;
});

Route::post('insert_id_telegram', function (Request $r){
    $mytime = Carbon::now();
    $now = $mytime->toDateTimeString();
    
    $username_telegram = $r->username_telegram;
    $id_type_user_telegram = $r->id_type_user_telegram;
    $code = $r->code;

    $rows_storage = TelegramStorage::select('*')->where([
        'username_telegram'=>$username_telegram,
        'code'=>$code
    ])->count();

    if($rows_storage == 0){
        TelegramStorage::create([
            "username_telegram"=>$username_telegram,
            "id_type_user_telegram"=>$id_type_user_telegram,
            "code"=>$code
        ]);
    }
    
    //insert user baru
    $rows_user = User::select('*')->where([
        'user_telegram'=>$username_telegram
    ])->count();

    if($rows_user == 0){
        User::create([
            "user_telegram"=>$username_telegram,
            "created_dtm"=>$now
        ]);
    }
    // broadcast(new WebsocketDemoEvent('somedata'));
    // $varsion = new versions();
    // $varsion->UpdateData();

    return "";
});

Route::post('update_status_user',function(Request $r){

    // header('Access-Control-Allow-Origin: *');
	// header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	// header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
	// header('Access-Control-Allow-Credentials: true');

    $id_user        =  $r->id_user;
    $id_status_user = $r->id_status_user;

    User::where('id_user', $id_user)
        ->update(
            [
                'id_status_user' => $id_status_user
            ]
      );

      
    
    // return redirect('/user/table');
});

Route::post('get_date',function(Request $r){

    $orders = Orders::select('*')->where([
        'id_order'=>4
    ])->get();

    $open_date = $orders[0]['open_date'];

    $date =  Date('Y-m-d h:i:s');
    $start_date = new DateTime($open_date);

    $since_start = $start_date->diff(new DateTime($date));
    echo $open_date."\n";
    echo $date."\n";

    $minutes = $since_start->days * 24 * 60;
    $minutes += $since_start->h * 60;
    $minutes += $since_start->i;

    echo $minutes.' minutes<br>';
    


});

Route::post('get_myir',function(Request $r){
    $myir               = $r->myir;
    
    $orders = orders::select('*')->where([
        'myir'=>$myir
    ])->get(); 
    
    if(count($orders) > 0){


        $id_requester       = $orders[0]->id_requester;
        $id_status_order    = $orders[0]->id_status_order;

        $m_status_order = new status_order();
        $m_user = new User();

        $nama_user = ($m_user->getUserFromId($id_requester)['user_telegram']);
        $status = $m_status_order->getStatusOrderFromId($id_status_order);

        $response  = "- Status tiket ".$myir." anda adalah ".$status."\n- Pelapor: ".$nama_user."\n\nTerimakasih";
    }else{
        $response  = "MYIR Tidak di temukan";
    }
    
    return $response ;
});

Route::post('update_status__',function(Request $r){

    $id_eksekutor = $r->id_eksekutor;
    $id_order = $r->id_order;
    $id_status_order = $r->id_status_order;
    $note = $r->note;
    $m_status_order = new status_order();

    $orders = Orders::select('*')->where([
        'id_order'=>$id_order
    ])->get();

    $id_requester = $orders[0]['id_requester'];
    $open_date = $orders[0]['open_date'];
    $myir = $orders[0]['myir'];
    $chat_id = $orders[0]['chat_id'];
    $message_id = $orders[0]['message_id'];
    $myir_text = "";

    
    if(intval($id_status_order) > 2){
       $myir_text = "MYIR ".$myir; 
    }

    if($id_status_order != 5 && $id_status_order != 4 ){
        Orders::where('id_order', $id_order)
          ->update(
              [
                  'message' => $note,
                  'id_status_order' => $id_status_order,
                  'id_eksekutor'=>$id_eksekutor
              ]
        );
    }else{

        
        $mytime = Carbon::now();
        $now = $mytime->toDateTimeString();

        $date =  Date('Y-m-d h:i:s');
        $start_date = new DateTime($open_date);

        $since_start = $start_date->diff(new DateTime($date));
        $minutes = $since_start->days * 24 * 60;
        $minutes += $since_start->h * 60;
        $minutes += $since_start->i;
        
        Orders::where('id_order', $id_order)
        ->update(
            [
                'message' => $note,
                'id_status_order' => $id_status_order,
                'id_eksekutor'=>$id_eksekutor,
                'close_date'=>$now,
                'durasi'=>$minutes
            ]
      );

    //   broadcast(new WebsocketDemoEvent('somedata'));
    // $varsion = new versions();
    // $varsion->UpdateData();
    
    }

    if($id_status_order == 3){
        $text = "Work Order sedang di Cek";
        $note = "";
        $note_text = "";
    }else{
        $users = User::select('*')->where([
            'id_user'=>$id_requester
        ])->get();
    
        $user_telegram = $users[0]['user_telegram'];

        if($note == "-"){
            $note_text = "";
        }else{
            $note_text = "\n\n *nb: ".$note;
        }

        $text = "Tiket ".$myir_text." Sdr. @".$user_telegram." Sudah masuk ke status ".$m_status_order->getStatusOrderFromId($id_status_order);
   
    }

    $token = "1160871670:AAH8OE-H-UfZ-kja_0mdLovJqx_kbpquQYc";    

    $data = [
        'text' => $text.$note_text,
        'chat_id' => $chat_id,
        'reply_to_message_id' => $message_id
    ];
    
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

    return null;
});

Route::post('sending_telegram', function (Request $r) {
    $token = "1160871670:AAH8OE-H-UfZ-kja_0mdLovJqx_kbpquQYc";
    $text = $r->text;
    $chat_id = $r->chat_id;

    $data = [
        'text' => $text,
        'chat_id' => $chat_id
    ];
    
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );
});

Route::post('code', function (Request $r){
    $storage_telegram = TelegramStorage::select('*')->where(  'username_telegram',"=",'azarDangga' )
    ->where('code','not like','-%')
    ->get();

    return $storage_telegram[0]->code;
    
});

Route::post('insert_order', function (Request $r){

    $mytime = Carbon::now();
    $now = $mytime->toDateTimeString();
    $myir = (isset($r->myir)? $r->myir : "-" );
    $orders = Orders::select('*')->where(
        'myir','=',$myir)
        ->where('id_status_order',"!=","4")
        ->where('id_status_order',"!=","5")
        ->get();

    if(count($orders) == 0){
        $username_telegram = $r->username_telegram;
        $message = $r->message;
        $myir = (isset($r->myir)? $r->myir : null );
        $email = (isset($r->email)? $r->email : null );
        $odp = (isset($r->odp)? $r->odp : null );
        $port = (isset($r->port)? $r->port : null );
        $category = (isset($r->category)? $r->category : null );
        $message_id = (isset($r->message_id)? $r->message_id : null );
        $chat_id = (isset($r->chat_id)? $r->chat_id : null );
    
        // cari id requester
        $user = User::select('*')->where([
            'user_telegram'=>$username_telegram
        ])->get();
    
        $id_requester = $user[0]->id_user;
    
        if($category == 1){
            $myir = null;
        }

        orders::create([
            "id_requester"=>$id_requester,
            "id_type_order"=>$category,
            "open_date"=>$now,
            "message"=>$message,
            'myir'=>$myir,
            'email'=>$email,
            'odp'=>$odp,
            'id_status_order'=>"1",
            'port'=>$port,
            'message_id'=>$message_id,
            'chat_id'=>$chat_id,
        ]);

        $response = "Data Anda Berhasil Terinsert :)";
        // broadcast(new WebsocketDemoEvent('somedata'));
        // $varsion = new versions();
        // $varsion->UpdateData();
        return  $response;
    }else{
        $id_requester       = $orders[0]->id_requester;
        $id_status_order    = $orders[0]->id_status_order;
        $chat_id    = $orders[0]->chat_id;
        $message_id    = $orders[0]->message_id;

        $m_status_order = new status_order();
        $m_user = new User();

        $nama_user = ($m_user->getUserFromId($id_requester)['user_telegram']);
        $status = $m_status_order->getStatusOrderFromId($id_status_order);

        $response  = "Tiket ".$myir." telah dilaporkan oleh @".$nama_user.", status tiket saat ini adalah ".$status;

            $token = "1160871670:AAH8OE-H-UfZ-kja_0mdLovJqx_kbpquQYc";
                    
            $data = [
                'text' => $response,
                'chat_id' => $chat_id,
                'reply_to_message_id' => $message_id
            ];
    
            
            // file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

        return $response;
    }
});

Route::post('delete_user', function (Request $r) {
    $id_user = $r->id_user;
    User::where('id_user', $id_user)->delete();
    return json_encode(array("status"=>true,"message"=>"Berhasil Terdelete"));
});

Route::post('getDetilUser', function (Request $r) {
        $id_user = $r->id_user;
        $user = User::select('*')->where([
            'id_user'=>$id_user
        ])->get();

        $role = role_user::select('*')->get();

        return json_encode(array("data_user"=>$user,"data_loker"=>$role));
});

Route::post('update_user', function (Request $r) {
    $id_user = $r->id_user;
    $username_telegram = $r->username_telegram;
    $id_locker = $r->id_locker;
    User::where('id_user', $id_user)
        ->update(
            [
                'username' => $username_telegram,
                'id_role_user' => $id_locker
            ]
      );


    return json_encode(array("status"=>true,"message"=>"update berhasil"));
});

Route::post('followUp', function (Request $r){

    $myir = $r->myir;
    $id_order = $r->id_order;
    $id_eksekutor = $r->id_eksekutor;

    $orders = Orders::select('*')->where([
        'id_order'=>$id_order
    ])->get();

    Orders::where('id_order', $id_order)
    ->update(
        [
            'id_status_order' => 6,
            'id_eksekutor'=>$id_eksekutor
        ]
  );

    $message_id = $orders[0]['message_id'];
    $chat_id = $orders[0]['chat_id'];

    $note_text = "Need FU MYIR ".$myir.", @nunk_sadt,@ekafredhani,@arfando";
    
    $token = "1160871670:AAH8OE-H-UfZ-kja_0mdLovJqx_kbpquQYc";
    $keyboard = array(
        "inline_keyboard" => array(array(array("text" => "Done", "callback_data" => "done_app"))),
        "one_time_keyboard" => true
    );

    $encodedKeyboard = json_encode($keyboard);
    $data = [
        'text' => $note_text,
        'chat_id' => $chat_id,
        'reply_to_message_id' => $message_id,
        'reply_markup' => $encodedKeyboard
    ];
    
    file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );

});

Route::post('feedback_fu', function (Request $r){
    $username = $r->username;
    $myir = $r->myir;
    // @azarDangga
    if($username == "nunk_sadt" || $username == "ekafredhani" || $username == "arfando" || $username == "telkom_askes"  || $username == "azarDangga"  || $username == "sofianawanti" ){
        Orders::where(['myir'=> $myir,'id_status_order'=>"6"])
          ->update(
              [
                  'id_status_order' => 1,
                  'id_eksekutor'=>null
              ]
        );
        // broadcast(new WebsocketDemoEvent('somedata'));
        // $varsion = new versions();
        // $varsion->UpdateData();
        return "Perintah sudah di eksekusi untuk MYIR $myir oleh user @".$username;
    }else{
        return "Maaf Anda Tidak Boleh Akses Perintah Ini";
    }
    
});

Route::post('cek', function (Request $r){
    $myir = $r->myir;

    $order = DB::table('orders')
            ->join('status_order', 'orders.id_status_order', '=', 'status_order.id_status_order')
            ->select('orders.id_order','status_order.deskripsi')
            ->where('orders.myir',$myir)
            ->orderBy("id_order","desc")
            ->orderBy("status_order.deskripsi")
            ->get();

    $deskripsi = $order[0]->deskripsi;      

    return json_encode(array("status"=>true,"message"=>"Status MYRI $myir adalah ".$deskripsi));

});


/**
 * p21
 * 
 */

Route::post('inputer', function (Request $r){
    $myir = $r->myir;
    $nama_calang = $r->nama_calang;
    $latitude = $r->latitude;
    $longitude = $r->longitude;
    $nama_odc = $r->nama_odp;

    $order = DB::table('orders')
            ->join('status_order', 'orders.id_status_order', '=', 'status_order.id_status_order')
            ->select('orders.id_order','status_order.deskripsi')
            ->where('orders.myir',$myir)
            ->orderBy("id_order","desc")
            ->orderBy("status_order.deskripsi")
            ->get();

    $deskripsi = $order[0]->deskripsi;      

    return json_encode(array("status"=>true,"message"=>"Status MYRI $myir adalah ".$deskripsi));

});

Route::post('check_inputer', function (Request $r){
    $wo = $r->wo;
    $calang = $r->calang;

    $arr = array("MYIR-$wo","SC$wo","IN$wo");
    
    $order1 = DB::table('orders')
            ->select('*')
            ->whereIn('wo',$arr)
            ->get();
         
    $row_data = 0;
    $order = "";
    if(count($order1) > 0){
        $status = true;
        $row_data = count($order1);  
        $order = $order1;
    }else{
        $status = false;
        $row_data = 0;
    }
    
    // else if(count($order2) > 0){
    //     $status = true;
    //     $row_data = count($order2); 
    //     $order = $order2;  
    // }else{
    //     $status = false;
    //     $row_data = 0;
    // }

    return json_encode(array("status"=>$status,"row"=>$row_data,"data"=>$order));

});


Route::post('get_last_from_other', function (Request $r){
    $m_orders = new orders();
    $last_wo = $m_orders->getLastFormatOther();
    echo $last_wo[0]->wo;
});


Route::post('put_inputer', function (Request $r){
    $mytime = Carbon::now();
    $m_orders = new orders();

    $now = $mytime->toDateTimeString();
    
    $id = $r->id;
    $wo = $r->wo;
    $nama_calang = $r->nama_calang;
    $latitude = $r->latitude;
    $longitude = $r->longitude;
    $odp = $r->odp;
    $alamat = $r->alamat;
    $kategori = $r->kategori;
    $inputer = $r->inputer;
    $type = $r->type;
    $type_order = $r->type_order;
    $date_kategori_other = $r->date_kategori_other;
    
    
    $date =  Date('Y-m-d H:i:s');

    $m_type_order = new type_order();
    $deskripsi_type_order = $m_type_order->getTypeOrderById($type_order)[0]->deskripsi;
    if($type_order == "1"){
        $wo = $deskripsi_type_order."-".$wo;
    }else{
        $wo = $deskripsi_type_order.$wo;
    }

    if($kategori != "3"){
        $date_kategori_other = null;
    }
    
    
    if($type_order != "4"){
        $data_stop = date('Y-m-d H:i:s', strtotime($date. ' + 3 days'));
    }else{

        $last_wo = $m_orders->getLastFormatOther();

        if(count($last_wo) > 0){
            $new_wo = intval(str_replace("OT","",$last_wo[0]->wo));
            $new_wo++;
            $wo = str_pad($new_wo, 3, '0', STR_PAD_LEFT);
            $wo = "OT".$wo;
    
        }else{
            $wo = "OT001";
        }
        $data_stop = date('Y-m-d H:i:s', strtotime($date. ' + 6 hours'));
        $odp = "-";
    }
    
    if($kategori == "5"){
        $status = "8";
    }else{
        $status = "0";
    }
    

    orders::create([
        "wo"=>$wo,
        "nama_calang"=>$nama_calang,
        "long"=>$longitude,
        "lat"=>$latitude,
        'alamat'=>$alamat,
        'nama_odp'=>$odp,
        'inputer'=>$inputer,
        'id_categori_order'=>$kategori,
        'create_dtm'=>$now,
        'last_update'=>$now,
        'target_selesai'=>$data_stop,
        'day_add_other'=>$date_kategori_other,
        'status'=>$status
    ]);
    // if($type == "1"){
        
    // }else{
    //     orders::where('id', $id)
    //     ->update(
    //         [
    //             "wo"=>$wo,
    //             "nama_calang"=>$nama_calang,
    //             "long"=>$longitude,
    //             "lat"=>$latitude,
    //             'alamat'=>$alamat,
    //             'nama_odp'=>$odp,
    //             'inputer'=>$inputer,
    //             'id_categori_order'=>$kategori,
    //             'create_dtm'=>$now,
    //             'last_update'=>$now,
    //             'target_selesai'=>$data_stop,
    //             'status'=>"0"
    //         ]
    //   );
    // }
    

    return json_encode(array("status"=>true));

});



Route::post('update_status',function(Request $r){
    $id = $r->id;
    $status = $r->status;
    $date =  Date('Y-m-d H:i:s');
    
    $param = [
        'status' => $status,
        'last_update' => $date,
   ];

    if(isset($r->keterangan)){
        if($status == "9"){
            $param["keterangan_pending"]=$r->keterangan;
        }else{
            $param["keterangan_cancel"]=$r->keterangan;
        }
        
    }

    if(isset($r->category)){
        $category = $r->category;
        $param["id_categori_order"]=$category;
        
    }

    if(isset($r->mitra)){
        if( $r->mitra != "eksisting"){
            $mitra = $r->mitra;
            $m_kategory_order = new kategory_order();
            $param["id_mitra"] =$mitra;
        }

        $data = Orders::select('*')->where([
            'id'=>$id
        ])->get();

        $id_kategori =  $data[0]->id_categori_order;
        $day_add_other =  $data[0]->day_add_other;

        if($id_kategori == "1"){
            $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +2 days'));
        }else if($id_kategori == "4"){
            $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +6 hours'));
        }else if($id_kategori == "5"){
            $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +2 days'));
        }else if($id_kategori == "6"){
            $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +2 days'));
        }else{
            $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +'.$day_add_other.' days'));
        }

        $param["target_selesai"] =$data_stop;
    }

    if(isset($r->kendala)){
        $kendala = $r->kendala;
        $param["keterangan_kendala"] =$kendala;
    }

    Orders::where('id', $id)->update($param);
});


Route::post('delete_mitra',function(Request $r){
    $id = $r->id;
    
    mitra::where('id_mitra', $id)->delete();
});

Route::post('update_status_cons',function(Request $r){

    $id = $r->id;

    $data = Orders::select('*')->where([
        'id'=>$id
    ])->get();

    $id_kategori =  $data[0]->id_categori_order;
    $day_add_other =  $data[0]->day_add_other;
    $date = date('Y-m-d H:i:s');

    if($id_kategori == "1"){
        $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +2 days'));
    }else if($id_kategori == "4"){
        $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +6 hours'));
    }else if($id_kategori == "5"){
        $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +2 days'));
    }else if($id_kategori == "6"){
        $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +2 days'));
    }else{
        $data_stop = date('Y-m-d H:i:s', strtotime($date. ' +'.$day_add_other.' days'));
    }

    Orders::where('id', $id)
    ->update(
        [
            'status' => "21",
            'last_update' => $date,
            'target_selesai' => $data_stop

        ]
  );   

  return json_encode(array("last_update"=>$date,"target_selesai"=>$data_stop));

});

Route::post('get_mitra',function(Request $r){
    $id = $r->id;
    $data = mitra::select('*')->where([
        'id_mitra'=>$id
    ])->get();

    return $data;

});
Route::get('oder_exceeded',function(Request $r){
    $now = date('Y-m-d H:i:s');
    
    $today = new DateTime(" 2020-12-12 05:03:17");
   
    $orders = Orders::select('*')->where([
        'status'=>2
    ])->get();


    foreach($orders as $data){
        $date = new DateTime($data->target_selesai);
        $interval = $today->diff($date);
        $in = $interval->format("%r%a");
        if($in < 0){
            Orders::where('id', $data->id)
          ->update(
              [
                  'status' => "11"
              ]
        );   
         echo "update id ".$data->id."<br/>";
         echo "update id ".$data->target_selesai."<br/>";
        }else{
            echo "no  ".$data->id."<br/>";
            echo "no id ".$data->target_selesai."<br/>";
        }
       
        
    }
    // $date_used = getDiffTwoDate($item->last_update,$now);
    //                    $date_all = getDiffTwoDate($item->last_update,$item->target_selesai);

    //                    $hasil_date = intval(($date_used/$date_all)*100);
});
Route::get('date',function(Request $r){
     echo date('Y-m-d H:i:s');
    // $str = "001";

    // $anInt = intval($str);

   // echo $anInt;

    //$invID = str_pad(10, 3, '0', STR_PAD_LEFT);

    //echo $invID;
});

Route::post('get_not_in_mitra',function(Request $r){
       return mitra::getNotInMitra($r->id);
});

Route::post('create_mitra',function(Request $r){
    $nama_mitra = $r->nama_mitra;
    $alamat = $r->alamat;
    $id_mitra_update = $r->id_mitra_update;

    if($id_mitra_update != ""){
        mitra::where('id_mitra', $id_mitra_update)
        ->update(
            [
                'nama_mitra' => $nama_mitra,
                'alamat' => $alamat,
            ]
      );
    }else{
        mitra::create([
            "nama_mitra"=>$nama_mitra,
            "alamat"=>$alamat
        ]);
    }

    
    
});




