<?php
date_default_timezone_set("Asia/Jakarta");

//  $now = date('Y-m-d H:i:s'); 
//  $stop_date = date('Y-m-d H:i:s', strtotime($now.' +6 hours'));  
//  echo $stop_date;
// exit();
include "conn.php";
$now = date('Y-m-d H:i:s'); 
$target_dir = "upload/";
$id     = $_POST['id_done'];
$type   = $_POST['type_done'];
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$target_file2 = $target_dir . basename($_FILES["file2"]["name"]);
$uploadOk = 1;
$imageFileType1 = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

if($type == "1"){
    $status = "8";
    $exe = "1";

    $stop_date = date('Y-m-d H:i:s', strtotime($now.' +6 hours'));  
}else{
    $status = "4";
    $exe = "3";
}

if($imageFileType1 != "kml"){
    
    echo "<script>alert('Maaf File anda Bukan KML ')</script>";
    echo "<script>window.location.href= 'http://dlisa.online/acak/table/$exe'</script>";
    exit();
}

if($imageFileType2 != "xlsx" && $imageFileType2 != "xls" ){
    echo "<script>alert('Maaf File anda Bukan xls')</script>";
    echo "<script>window.location.href= 'http://dlisa.online/acak/table/$exe'</script>";
    exit(); 
}

    // $check = getimagesize($_FILES["file"]["tmp_name"]);
    // if($check !== false) {
        // echo "update orders set status = $status , last_update = now(),target_selesai = '$stop_date' where id = $id";
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["file2"]["tmp_name"], $target_file2) ) {
            echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
            if($type == "1"){
                mysqli_query($conn,"update orders set status = $status , last_update = '$now',target_selesai = '$stop_date' where id = $id");
            }else{
                mysqli_query($conn,"update orders set status = $status , last_update = '$now' where id = $id");
            }
            
            
            mysqli_query($conn,"insert into attach_file(type_file,url,id_order,status,create_dtm)values(1,'".basename($_FILES["file"]["name"])."','$id',$status,now())")or die("error: "."insert into attach_file(type_file,url,id_order,status,create_dtm)values($type,'".basename($_FILES["file"]["name"])."','$id',8,now())");
            mysqli_query($conn,"insert into attach_file(type_file,url,id_order,status,create_dtm)values(2,'".basename($_FILES["file2"]["name"])."','$id',$status,now())")or die("error2");
            echo "<script>alert('Upload Berhasil')</script>";
            echo "<script>window.location.href= 'http://dlisa.online/acak/table/$exe'</script>";
            exit(); 
        } else {
            echo "<script>alert('Upload Gagal')</script>";
            echo "<script>window.location.href= 'http://dlisa.online/acak/table/$exe'</script>";
            exit();
            // echo "Sorry, there was an error uploading your file.";
        }
    // } else {
    //     echo "File is not an image.";
    //     $uploadOk = 0;
    // }

?>