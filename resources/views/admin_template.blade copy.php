@php
use App\status_order;
use App\kategory_order;
use App\role_user;


    $id_user = session('id_user') ;
    $http_host =  $_SERVER['HTTP_HOST'];
    $http_origin = str_replace(":8000","",$http_host);
    $http_host = "http://".$http_host;
    $http_origin = "http://".$http_origin;

    $http_self_ = $_SERVER['PHP_SELF'];
    $data_menu = status_order::MenuInbox();

    $role_status = role_user::select('*')->get();
   
    $m_kategory_order = new kategory_order();
    $data_category = $m_kategory_order->allKategori();
@endphp
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>AdminLTE 3| Starter</title>

  <style type="text/css">
  .frame::-webkit-scrollbar {
    -webkit-appearance: none;
}

.frame::-webkit-scrollbar-thumb {
    border-radius: 8px;
    border: 2px solid white;
    background-color: rgba(0, 0, 0, .5);
}

  </style>
  <!-- Font Awesome Icons -->

  <link rel="stylesheet" href='{{ asset("bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css")}}'>
  <!-- Theme style -->
  <link rel="stylesheet" href='{{ asset("bower_components/admin-lte/dist/css/adminlte.min.css")}}'>

  <!-- daterange picker -->
  <link rel="stylesheet" href='{{ asset("bower_components/admin-lte/plugins/daterangepicker/daterangepicker.css")}}'>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li> 
    </ul>

    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src='{{ asset("bower_components/admin-lte/dist/img/AdminLTELogo.png")}}' alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3 {{ session('key') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src='{{ asset("bower_components/admin-lte/dist/img/user2-160x160.jpg")}}' class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          {{-- <li class="nav-item has-treeview menu-open"> --}}
            {{-- <a href="#" class="nav-link active"> --}}
              <li class="nav-item has-treeview ">
                  <a href="{{url('/inputer')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Input
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Inbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">   
            @foreach ($role_status as $i)
              <li class="nav-item">
                  <a href="{{url('/table')}}/{{$i->id_role}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      
                     {{$i->deskripsi}}
                    </p>
                  </a>
                </li>
            @endforeach
          </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;"> 
           
                <li class="nav-item">
                  <a href="{{url('/report/mitra/permintaan/1')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                     Performansi Mitra
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/report/mitra/permintaan/2')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Rata-rata Penyelesaian
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/report/mitra/permintaan/2')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Custome Query Report
                    </p>
                  </a>
                </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;"> 
           
                <li class="nav-item">
                  <a href="{{url('/user/table/1')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                     Approve
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/user/table/2')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Edit User
                    </p>
                  </a>
                </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="{{url('login')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('header')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              @yield('menu_title')
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src='{{ asset("bower_components/admin-lte/plugins/jquery/jquery.min.js")}}'></script>
<!-- Bootstrap 4 -->
<script src='{{ asset("bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}'></script>
<!-- AdminLTE App -->
<script src='{{ asset("bower_components/admin-lte/dist/js/adminlte.min.js")}}'></script>


<script>
    function hay(){
      alert("test")
    }

    $(document).ready(function(){
          var x = setInterval(function() {

          }, 10000);
          
          var hostname = location.host;
          hostname = "http://"+hostname
          $('.ogp').click(function(){
            var atribut = $(this).attr('id');
            var id_order = atribut.replace('ogp_','')
            var id_eksekutor = $('#id_user').val()

            $.post(hostname+'/api/update_status',
            {
              note:"-",
              id_eksekutor:id_eksekutor,
              id_order :id_order,
              id_status_order:3
            },
            function($res,$req){
                window.location.href= hostname+"/tableOrder"
            })
          })

          $('.pending').click(function(){
            var atribut = $(this).attr('id');
            var id_order = atribut.replace('pending_','')
            var id_eksekutor = $('#id_user').val()

            $('#status').html("<b>PENDING</b>")
            $('#status_order').val('2')
            $('#id_order').val(id_order)

          })

          $('.return').click(function(){
            var atribut = $(this).attr('id');
            var id_order = atribut.replace('return_','')
            var id_eksekutor = $('#id_user').val()

            $('#status').html("<b>RETURN</b>")
            $('#status_order').val('4')
            $('#id_order').val(id_order)

          })

          $('.close_').click(function(){
            var atribut = $(this).attr('id');
            var id_order = atribut.replace('close_','')
            var id_eksekutor = $('#id_user').val()

            $('#status').html("<b>CLOSE</b>")
            $('#status_order').val('5')
            $('#id_order').val(id_order)
          })


          $('.message').click(function(){
            // alert("test")
            var atribut = $(this).attr('id');
            var id_order = atribut.replace('td_','')
            var message = $('#message_'+id_order).val()
            $('#label_message').html(message)

          })

          $('#btn_save').click(function(){

            var id_order = $('#id_order').val()
            var status_order = $('#status_order').val()
            var id_eksekutor = $('#id_user').val()
            var note = $('#note').val()
              $.post(hostname+'/api/update_status',
              {
                note:note,
                id_eksekutor:id_eksekutor,
                id_order :id_order,
                id_status_order:status_order
              },
              function($res,$req){
                  window.location.href= hostname+"/tableOrder"
              })
          })


          $('.approve').click(function(){

            // var atribut = $(this).attr('id');
            // var id_order = atribut.replace('close_','')
            var atribut = $(this).attr('id');
            var id_user = atribut.replace('approve_','')
            // var nama_user = $("#"+id_user).html()
            // alert(nama_user)
            // $('#response').html("Approve "+nama_user+" ?")

              $.post(hostname+'/api/update_status_user',
              {
                id_user:id_user,
                id_status_user:2
              },
              function($res,$req){
                alert("Approve Berhasil")
                  window.location.href= hostname+"/user/table"
              })
          })

          $('.restore').click(function(){

            var atribut = $(this).attr('id');
            var id_user = atribut.replace('restore_','')
              $.post(hostname+'/api/update_status_user',
              {
                id_user:id_user,
                id_status_user:3
              },
              function($res,$req){
                alert("restore Berhasil")
                  window.location.href= hostname+"/user/table"
              })
          })

          $('.block').click(function(){

            var atribut = $(this).attr('id');
            var id_user = atribut.replace('block_','')

              $.post(hostname+'/api/update_status_user',
              {
                id_user:id_user,
                id_status_user:4
              },
              function(res,req){
                alert("Block Berhasil")
                  window.location.href= hostname+"/user/table"
              })
          })   

          /**
          * Page user
          */

          $('.alter_delete').click(function(){
          
              var atr = $(this).attr("id")
              var id = atr.replace("alter_delete_","")
              
              var nama_user = $('#'+id).html()

              $("#id_user").val(id)
              $('#response').html("Delete "+nama_user+" ?")
          }) 

          $('#btn_delete').click(function(){
            var id_user = $("#id_user").val()
            $.post(hostname+"/api/delete_user",{
              id_user:id_user
            },function(res,req){  
              var json = JSON.parse(res)            
              alert(json.message)
              window.location.href= hostname+"/user/table"
            })
          })

          $('.alter_edit').click(function(){
            var atr = $(this).attr("id")
            var id_user = atr.replace("alter_update_","")
            $.post(hostname+"/api/getDetilUser",{
              id_user:id_user
            },function(res,req){  
              var json = JSON.parse(res)   
              var user_telegram = json['data_user'][0]['username']
              var id_locker_user = json['data_user'][0]['id_role_user']
              var id_locker = json['data_loker']

              var option = ""
              
              id_locker.forEach(element => {
                if(element.id_role != "4"){
                  if(id_locker_user == element.id_role){
                    option += "<option selected value="+element.id_role+">"+element.deskripsi+"</option>"
                  }else{
                    option += "<option value="+element.id_role+">"+element.deskripsi+"</option>"
                  }
                }
                
                
              });

              $("#id_user_edit").val(id_user) 
              $("#username").val(user_telegram) 
              $("#id_locker").html(option) 
            })
          })

          $('#btn_edit').click(function(){
            var id_user = $("#id_user_edit").val() 
            var username_telegram = $("#username").val() 
            var id_locker = $("#id_locker").val();

            $.post(hostname+"/api/update_user",{
              id_user:id_user,
              username_telegram:username_telegram,
              id_locker:id_locker
            },function(res,req){ 
              window.location.href= hostname+"/user/table/2"
             })
          })


          // page order modul FU
          $('.fu').click(function(){
            var atr = $(this).attr("id")
            var id_order = atr.replace("fu_","")
            var myir = $("#myir_"+id_order).html()
            var id_eksekutor = $('#id_user').val()
            alert("MYIR "+myir+" Sudah Di Follow Up ya...")
            $.post(hostname+"/api/followUp",{
              id_order:id_order,
              myir:myir,
              id_eksekutor:id_eksekutor
            },function(res,req){  
              window.location.href= hostname+"/tableOrder"
            })
          })

          // page pivot
          $('#filter_pivot').click(function(){
            var win = window.location.href
            var ar_win = win.split("/")
            var ar_win_row = ar_win.length

            var jenis_page = ar_win[ar_win_row-1]
            var date_start = $('#date_start').val()
            var date_end = $('#date_end').val()

            if(date_start == "" || date_end==""){
              alert("Tanggal Harus Terisi Semua ya")
              return true
            }

            if(jenis_page == "eksekutor"){
              window.location.href= hostname+"/report/eksekutor/"+date_start+"/"+date_end
            }else{
              window.location.href= hostname+"/report/permintaan/"+date_start+"/"+date_end
            }
            
          })

          // page line
          $('#filter_line').click(function(){
            var win = window.location.href
            var ar_win = win.split("/")
            var ar_win_row = ar_win.length

            var jenis_page = ar_win[ar_win_row-1]
            var date_start = $('#date_start').val()
            var date_end = $('#date_end').val()

            if(date_start == "" || date_end==""){
              alert("Tanggal Harus Terisi Semua ya")
              return true
            }

            if(jenis_page == "eksekutor"){
              window.location.href= hostname+"/grafik/line/eksekutor/"+date_start+"/"+date_end
            }else{
              window.location.href= hostname+"/grafik/line/permintaan/"+date_start+"/"+date_end
            }
            
          })

          $("#entity").change(function(){
            var value  =  $("#entity").val()

            var date_start = $('#date_start').val()
            var date_end = $('#date_end').val()

            
            if(value == "eksekutor"){
              if(date_start == ""){
                window.location.href= hostname+"/grafik/line/eksekutor"
              }else{
                window.location.href= hostname+"/grafik/line/eksekutor/"+$date_start+"/"+date_end
              }
              
            }else{
              if(date_start == ""){
                window.location.href= hostname+"/grafik/line/permintaan"
              }else{
                window.location.href= hostname+"/grafik/line/permintaan/"+$date_start+"/"+date_end
              }
              
            }
          });

    /**
      * 
      * 
      * 
      * 
      * p21
      */

    $('#submit_inputer').click(function(){
        var wo = $('#wo').val()
        var nama_calang = $('#calang').val()
        var latitude = $('#latitude').val()
        var longitude = $('#longitude').val()
        var odp = $('#odp').val()
        var alamat = $('#alamat').val()
        var kategori = $('#kategori').val()
        var type = $('#type').val()
        var id = $('#id').val()


        // not valid ODP
        try{
            let t = odp.split("/")
            let t2 = t[0].split("-")
            let salah = 0
            
         try{
           if(t.length != 2){
              salah++
            }
         }catch(e){
            salah++
         }  
            
          try{
              if(t2.length != 3){
                salah++
              }
          }catch(e){
             salah++
          }
            
          try{
            if(t2[0] != "ODP"){
              salah++
            }
          }catch(e){
            salah++
          }
        
          try{
            if(t2[1].length != 3){
              salah++
            }
          }catch(err){
            salah++
          }

          try{
              if(t2[2].length > 3 || t2[2].length < 2){
                salah++
              }
          }catch(e){
            salah++
          }
            
          try{
            if(t[1].length > 3 || t[1].length < 2 || isNaN(t[1])){
              salah++
            }
          }catch(er){
            salah++
          }
            
          if(salah > 0){
            alert("Penulisan ODP tidak benar, contoh: ODP-PWT-FAB/001")
            return true
          }
          
        }catch(err){
          alert("Penulisan ODP tidak benar, contoh: ODP-PWT-FAB/001")
          return true
        }

        var arr = {
          id:id,
          wo:wo,
          nama_calang:nama_calang,
          latitude:latitude,
          longitude:longitude,
          odp:odp,
          alamat:alamat,
          kategori:kategori,
          type:type,
          inputer:"{{$id_user}}"

        }

        //alert(JSON.stringify(arr)) 
        
        $.post(hostname+'/api/put_inputer',arr,
        function(res,req){
            window.location.href= hostname+"/inputer"
        })
    })

    $('#calang').keypress(function (e) {
      var key = e.which;
      if(key == 13)  // the enter key code
       {
          var wo = $('#wo').val()
          var calang = $('#calang').val()
          if(wo == ""){
              alert("wo harus terisi")
              return true
          }

          if(calang == ""){
              alert("Nama Calang harus terisi")
              return true
          }
          $.post(hostname+'/api/check_inputer',
          {
            wo:wo,
            calang:calang
          },
          function(res,req){
              
              var str = JSON.parse(res)
              if(str.status){
                if(str.row > 0){
                  $( "#popup" ).trigger( "click");
                  $('#lanjut').click(function(){
                      $('#id').val(str['data'][0]['id'])
                      $('#latitude').val(str['data'][0]['lat'])
                      $('#longitude').val(str['data'][0]['long'])
                      $('#odp').val(str['data'][0]['nama_odp'])
                      $('#alamat').val(str['data'][0]['alamat'])
                      $('#type').val("2")
                      var option = "<option>- Pilih Kategori -</option>"
                      
                      @foreach($data_category as $item)
                        var selected = ""
                        if({{$item->id_kategori_order}} ==  str['data'][0]['id_categori_order']){
                            selected ="selected"
                        }
                        
                        option +=" <option "+selected+" value='{{$item->id_kategori_order}}'>{{$item->deskripsi}}</option>"
                      @endforeach
                       $('#kategori').html(option);
                  })
                } 
              }
              
              $('#after_calang').show()
              $('#submit_inputer').show()
              
              
          })
       }
     });

     $('.eko').click(function(){
            var win = window.location.href
            var ar_win = win.split("/")
            var ar_win_row = ar_win.length  

            var atribut = $(this).attr('id');
            var id = atribut.replace('eko_','')

            $.post(hostname+'/api/update_status',
          {
            id:id,
            status:"1",
            category:"2",
          },
          function(res,req){
            alert("Update Berhasil")
            window.location.href= hostname+"/table/1"
      })


      })


      $('.done').click(function(){
            var win = window.location.href
            var ar_win = win.split("/")
            var ar_win_row = ar_win.length  

            var atribut = $(this).attr('id');
            var id = atribut.replace('done_','')
            var halaman = $('#jenis_halaman').val()

            var status = "0"

            $('#id_done').val(id)
            
            /*$.post(hostname+'/api/update_status',
          {
            id:id,
            status:"1",
            category:"2",
          },
          function(res,req){
            alert("Update Berhasil")
            window.location.href= hostname+"/table/"+halaman
          }) */
      })

       $('#btn_save_done').click(function(){
            var win = window.location.href
            var ar_win = win.split("/")
            var ar_win_row = ar_win.length  

            var halaman = $('#jenis_halaman').val()
            var id = $('#id').val()
            var mitra = $('#mitra').val()

            if(mitra == "- Pilih Mitra -"){
                alert("Pilih Mitra terlebih Dahulu")
                return true
            }

            $.post(hostname+'/api/update_status',
          {
            id:id,
            status:"2",
            mitra:mitra,
          },
          function(res,req){
            alert("Update Berhasil")
            window.location.href= hostname+"/table/"+halaman
          })
      })

      $('.set_id').click(function(){ 

            var atribut = $(this).attr('id');
            var id = atribut.replace('done_','')
            var id = id.replace('kendala_','')
            var halaman = $('#jenis_halaman').val()

            $('#id').val(id)
          
      })

      $('#btn_save_kendala').click(function(){

            var halaman = $('#jenis_halaman').val()
            var id = $('#id').val()
            var kendala = $('#isi_kendala').val()

            $.post(hostname+'/api/update_status',
          {
            id:id,
            status:"3",
            kendala:kendala,
          },
          function(res,req){
            alert("Update Berhasil")
            window.location.href= hostname+"/table/"+halaman
          })
      })

       $('.delete_mitra').click(function(){ 

            var atribut = $(this).attr('id');
            var id = atribut.replace('delete_mitra_','')
            var nama = $('#nama_'+id).text()

            $('#delete_val_mitra').html(nama)
            $('#id_mitra_delete').val(id)
          
      })


       $('#btn_delete_mitra').click(function(){ 

           var id =  $('#id_mitra_delete').val()
          $.post(hostname+'/api/delete_mitra',
          {
            id:id
          },
          function(res,req){
            alert("Delete Berhasil")
            window.location.href= hostname+"/mitra/table"
          })

          
      })
      
      $('.edit_mitra').click(function(){ 
            var atribut = $(this).attr('id');
            var id = atribut.replace('update_mitra_','')
             $('#id_mitra_update').val(id)

             $.post(hostname+'/api/get_mitra',
              {
                id:id
              },
              function(res,req){
                  //var data = JSON.parse(res);
                  //alert(JSON.stringify(res))
                  
                  $('#id_mitra_update').val(res['0']['id_mitra'])
                  $('#nama_mitra').val(res['0']['nama_mitra'])
                  $('#alamat').val(res['0']['alamat'])
              })
        
      })

      $('#Create').click(function(){ 
        $('#id_mitra_update').val('')
      })

      $('#btn_save_mitra').click(function(){ 

           var nama_mitra =  $('#nama_mitra').val()
           var alamat     =  $('#alamat').val()
           var id_mitra_update     =  $('#id_mitra_update').val()

          $.post(hostname+'/api/create_mitra',
          {
            id_mitra_update:id_mitra_update,
            nama_mitra:nama_mitra,
            alamat:alamat
          },
          function(res,req){
            alert("Berhasil Tersimpan")
            window.location.href= hostname+"/mitra/table"
          })

          
      })


      

    });


    


</script>
<!-- date-range-picker -->
<script src='{{asset("bower_components/admin-lte/plugins/daterangepicker/daterangepicker.js")}}'></script>
<script src='{{asset("bower_components/admin-lte/plugins/flot/jquery.flot.js")}}'></script>
<script src='{{asset("bower_components/admin-lte/plugins/flot-old/jquery.flot.resize.min.js")}}'></script>
</body>
</html>
