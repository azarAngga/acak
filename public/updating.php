<?php

date_default_timezone_set("Asia/Jakarta");

//  $now = date('Y-m-d H:i:s'); 
//  $stop_date = date('Y-m-d H:i:s', strtotime($now.' +6 hours'));  
//  echo $stop_date;
// exit();
include "conn.php";
$q  = mysqli_query($conn,"select * from orders where inputer ='' ");
while($f = mysqli_fetch_assoc($q)){
    $id = $f['id'];
    // $nama = $f['inputer_origin'];
    // $f2 = mysqli_fetch_assoc(mysqli_query($conn,"select * from users where nama = '$nama'"));
    mysqli_query($conn,"update orders set inputer = '14', create_dtm = '2020-12-02 12:34:57',status = 0,target_selesai = '2020-12-05 12:34:57',last_update = '2020-12-02 12:34:57' where id = $id")or die("error query");
    echo $f2['id_user'];

}
?>