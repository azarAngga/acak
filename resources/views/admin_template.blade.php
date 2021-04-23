@php
use App\status_order;
use App\kategory_order;
use App\role_user;

  
    $id_user = Session::get('id_user');
    $id_locker = Session::get('id_locker');

    if($id_user == ""){
      //redirect('/login');
      header("Location: http://acak.web.id");
      echo "not";
      exit();
    }

    $val_parameter = "";

    if(isset($param)){
      $val_parameter =$param;
    }

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
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Options Admin - Responsive Web Application Kit</title>

        <!-- ========== COMMON STYLES ========== -->
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/bootstrap.min.css')}}" media="screen" >
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/font-awesome.min.css')}}" media="screen" >
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/animate-css/animate.min.css')}}" media="screen" >
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/lobipanel/lobipanel.min.css')}}" media="screen" >

        <!-- ========== PAGE STYLES ========== -->
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/prism/prism.css')}}" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/toastr/toastr.min.css')}}" media="screen" >
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/icheck/skins/line/blue.css')}}" >
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/icheck/skins/line/red.css')}}" >
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/icheck/skins/line/green.css')}}" >
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/bootstrap-tour/bootstrap-tour.css')}}" >
        <style>
          .search-head{
            margin:10px;

          }
        </style>
        <!-- ========== THEME CSS ========== -->
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/css/main.css')}}" media="screen" >

        <!-- ========== MODERNIZR ========== -->
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/modernizr/modernizr.min.js')}}"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <nav class="navbar top-navbar bg-white box-shadow">
            	<div class="container-fluid">
                    <div class="row">
                        <div class="navbar-header no-padding">
                			<a class="navbar-brand" href="index.html">
                        ACAK  
                			</a>
                        <span class="small-nav-handle hidden-sm hidden-xs"><i class="fa fa-outdent"></i></span>
                			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">  
                				    <span class="sr-only">Toggle navigation</span> 
                				    <i class="fa fa-ellipsis-v"></i>  
                      </button>
                      <button type="button" class="navbar-toggle mobile-nav-toggle" >
                				<i class="fa fa-bars"></i>
                      </button>
                      
                		</div>
                        <!-- /.navbar-header -->

                		<div class="collapse navbar-collapse" id="navbar-collapse-1">
                      <form action="{{url('table/search')}}" method="POST" class="form" >
                        {{ csrf_field()}}
                			<ul class="nav navbar-nav search-head" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                          
                          <li class="hidden-sm hidden-xs ">
                            <select name="param" class="form-control ">
                              <option value="wo">WO ID</option>
                            </select>
                          </li>  
                          <li class="hidden-sm hidden-xs"><input type="text" name="wo"
                             @if(isset($param))
                                 value='{{$wo}}'
                             @endif
                             placeholder="..." class="form-control "/></li>  
                          <li class="hidden-sm hidden-xs"><input type="submit" class="form-control color-primary" value="Search"/></li>  
                        
                      </ul>
                    </form>
                      
                            <!-- /.nav navbar-nav -->

                			<ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                <li class="dropdown">
                					{{--  <a href="#" class="dropdown-toggle bg-primary tour-one" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus-circle"></i> Add New <span class="caret"></span></a>  --}}
                					<ul class="dropdown-menu" >
                						<li><a href="#"><i class="fa fa-plus-square-o"></i> Customer</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square-o"></i> Employee</a></li>
                						<li><a href="#"><i class="fa fa-plus-square-o"></i> Estimate</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square-o"></i> Task</a></li>
                						<li><a href="#"><i class="fa fa-plus-square-o"></i> Team Member</a></li>
                						<li role="separator" class="divider"></li>
                						<li><a href="#">Create Order</a></li>
                						<li role="separator" class="divider"></li>
                						<li><a href="#">Generate Report</a></li>
                					</ul>
                				</li>
                                <!-- /.dropdown -->
                				<li class="dropdown tour-two">
                					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User<span class="caret"></span></a>
                					<ul class="dropdown-menu profile-dropdown">
                						<li class="profile-menu bg-gray">
                						    <div class="">
                						        <img src="http://placehold.it/60/c2c2c2?text=User" alt="John Doe" class="img-circle profile-img">
                                                <div class="profile-name">
                                                    <h6>User</h6>
                                                
                                                </div>
                                               
                						    </div>
                						</li>
                						<li role="separator" class="divider"></li>
                						<li><a href="{{url('/logout')}}" class="color-danger text-center"><i class="fa fa-sign-out"></i> Logout</a></li>
                					</ul>
                				</li>
                                <!-- /.dropdown -->
                                
                			</ul>
                            <!-- /.nav navbar-nav navbar-right -->
                		</div>
                		<!-- /.navbar-collapse -->
                    </div>
                    <!-- /.row -->
            	</div>
            	<!-- /.container-fluid -->
            </nav>

            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                    <div class="left-sidebar fixed-sidebar bg-black-300 box-shadow tour-three">
                        <div class="sidebar-content">
                            <div class="user-info closed">
                                <img src="http://placehold.it/90/c2c2c2?text=User" alt="John Doe" class="img-circle profile-img">
                                <h6 class="title">John Doe</h6>
                                <small class="info">PHP Developer</small>
                            </div>
                            <!-- /.user-info -->

                            <div class="sidebar-nav">
                                <ul class="side-nav color-gray">
                                    <li class="nav-header">
                                        <span class="">Menu</span>
                                    </li>
                                    <li>
                                      <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> <span>HOME</span></a>
                                  </li>
                                    <li>
                                        <a href="{{url('/inputer')}}"><i class="fa fa-dashboard"></i> <span>INPUT</span></a>
                                    </li>
                                    <li class="has-children">
                                      <a href="#"><i class="fa fa-file-text"></i> <span>Inbox</span> <i class="fa fa-angle-right arrow"></i></a>
                                      <ul class="child-nav">
                                        @php
                                        $no = 0;
                                      @endphp
                                      @foreach ($role_status as $i)
                                          @if ($i->id_role == "1" && ($id_locker == "1"  || $id_locker == "2"))
                                            <li><a href="{{url('/table')}}/{{$i->id_role}}">{{$i->deskripsi}}</a></li>
                                          @endif
                            
                                          @if ($i->id_role == "2" && ($id_locker == "1"  || $id_locker == "4"))
                                            <li><a href="{{url('/table')}}/{{$i->id_role}}">{{$i->deskripsi}}</a></li>
                                          @endif
                                          
                                          @if ($i->id_role == "3" && ($id_locker == "1"  || $id_locker == "3"))
                                            <li><a href="{{url('/table')}}/{{$i->id_role}}">{{$i->deskripsi}}</a></li>
                                          @endif
                            
                                          @if ($i->id_role == "4" && ($id_locker == "1"  || $id_locker == "2"))
                                            <li><a href="{{url('/table')}}/{{$i->id_role}}">{{$i->deskripsi}}</a></li>
                                          @endif
                                        @php
                                          $no++;
                                        @endphp
                                      @endforeach
                                      </ul>
                                  </li>
                                  <li class="has-children">
                                    <a href="#"><i class="fa fa-file-text"></i> <span>Summary</span> <i class="fa fa-angle-right arrow"></i></a>
                                    <ul class="child-nav">
                                      <li><a href="{{url('/table')}}/5">Pending</a></li>
                                      <li><a href="{{url('/table')}}/6">Cancel </a></li>
                                      <li><a href="{{url('/table')}}/7">Close</a></li>
                                    </ul>
                                </li>
                                <li class="has-children">
                                  <a href="#"><i class="fa fa-file-text"></i> <span>Report</span> <i class="fa fa-angle-right arrow"></i></a>
                                  <ul class="child-nav">
                                    <li><a href="{{url('/report/mitra/permintaan/1')}}">performansi mitra</a></li>
                                    <li><a href="{{url('/report/mitra/permintaan/2')}}">rata-rata penyelesaian</a></li>
                                  </ul>
                                </li>
                                @if ($id_locker == "1")
                                <li class="has-children">
                                  <a href="#"><i class="fa fa-file-text"></i> <span>User</span> <i class="fa fa-angle-right arrow"></i></a>
                                  <ul class="child-nav">
                                    <li><a href="{{url('user/table')}}/1">Approve</a></li>
                                    <li><a href="{{url('user/table')}}/2">Update</a></li>
                                  </ul>
                                </li>
                                @endif

                             
                            </div>
                            <!-- /.sidebar-nav -->
                        </div>
                        <!-- /.sidebar-content -->
                    </div>
                    <!-- /.left-sidebar -->

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">@yield('header')</h2>
                                    {{--  <p class="sub-title">One stop solution for perfect admin dashboard!</p>  --}}
                                </div>
                                <!-- /.col-sm-6 -->
                                <div class="col-sm-6 right-side">
                                    {{--  <a class="btn bg-black toggle-code-handle tour-four" role="button">Toggle Code!</a>  --}}
                                </div>
                                <!-- /.col-sm-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-sm-6">
                                    <ul class="breadcrumb">
                                     @yield('menu_title')
            					            	</ul>
                                </div>
                                <!-- /.col-sm-6 -->
                                
                                <!-- /.col-sm-6 -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                  @yield('content')
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                        
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/jquery/jquery-2.2.4.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/bootstrap/bootstrap.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/pace/pace.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/lobipanel/lobipanel.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/iscroll/iscroll.js')}}"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/prism/prism.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/waypoint/waypoints.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/counterUp/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/amcharts/amcharts.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/amcharts/serial.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/amcharts/plugins/export/export.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('bower_components/themplate_season_3/options-admin/js/amcharts/plugins/export/export.css')}}" type="text/css" media="all" />
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/amcharts/themes/light.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/toastr/toastr.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/icheck/icheck.min.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/bootstrap-tour/bootstrap-tour.js')}}"></script>

        <!-- ========== THEME JS ========== -->
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/main.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/production-chart.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/traffic-chart.js')}}"></script>
        <script src="{{asset('bower_components/themplate_season_3/options-admin/js/task-list.js')}}"></script>
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
                        window.location.href= hostname+"/user/table/1"
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
                        window.location.href= hostname+"/user/table/1"
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
                        window.location.href= hostname+"/user/table/1"
                    })
                })   
      
                /**
                * Page user
                */
      
                $('.alter_delete').click(function(){
                
                    var atr = $(this).attr("id")
                    var id = atr.replace("alter_delete_","")
                    
                    
                    $("#id_user").val(id)
                    $('#response').html("Delete "+nama_user+" ?")
                }) 
      
                $('.pending_design').click(function(){
                
                  var atr = $(this).attr("id")
                  var id = atr.replace("pending_design_","")
      
                  $("#id_cancel_pending").val(id)
                  $("#status_order_cancel_pending").val(9)
                  $('#isi_keterangan_cancel_pending').prop('placeholder', "Keterangan Pending");
                  $('#response').html("Yakin untuk mengubah status menjadi PENDING DESAIN ?")
      
              }) 
      
              $('.cancel_design').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("cancel_design_","")
                
      
                $("#id_cancel_pending").val(id)
                $("#status_order_cancel_pending").val(10)
                $('#isi_keterangan_cancel_pending').prop('placeholder', "Keterangan Cancel");
                $('#response').html("Yakin untuk mengubah status menjadi CANCEL ?")
              }) 
      
              $('.accept_kons').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("accept_kons_","")
                $('#accept_kons_'+id).hide()
                $('#done_kons_'+id).show() 
                $('#kendala_kons_'+id).show() 
                $('#cancel_kons_'+id).show() 
                $('#return_design_'+id).show() 
                $('#return_assign_'+id).hide() 

                console.log(id)
                console.log(hostname+'/api/update_status_cons')
                $.post(hostname+'/api/update_status_cons',
                {
                  id:id
                },
                function(res,req){
                  alert("Update Berhasil")
                  window.location.href= hostname+"/table/3"
                })
              })
              
            
              $('.cancel_kons').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("cancel_kons_","")
                
      
                $("#id_cancel_return").val(id)
                $("#status_order_cancel_return").val(5)
                $('#response_cancel_return').html("Yakin untuk mengubah status menjadi CANCEL ?")
              }) 
              
              $('.approve_pending_kons').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("approve_pending_kons_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(14)
                $('#response_popup').html("Yakin untuk Approve order ?")
              }) 
              $('.approve_cancel_design').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("approve_cancel_design_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(18)
                $('#response_popup').html("Yakin untuk Approve order ?")
              }) 
      
              $('.approve_cancel_design').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("approve_cancel_design_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(19)
                $('#response_popup').html("Yakin untuk Approve order ?")
              }) 
              $('.decline_cancel_kons').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("decline_cancel_kons_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(2)
                $('#response_popup').html("Yakin untuk Decline order ?")
              }) 
              $('.decline_cancel_design').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("decline_cancel_design_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(0)
                $('#response_popup').html("Yakin untuk Decline order ?")
              }) 
      
              $('.resume_pending').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("resume_pending_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(2)
                $('#response_popup').html("Yakin untuk Resume order ?")
              }) 
              
              $('.decline_pending_design').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("decline_pending_design_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(0)
                $('#response_popup').html("Yakin untuk Decline order ?")
              }) 
      
              $('.decline_pending_kons').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("decline_pending_kons_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(2)
                $('#response_popup').html("Yakin untuk Decline order ?")
              }) 
      
              $('.approve_pending_design').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("approve_pending_design_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(13)
                $('#response_popup').html("Yakin untuk Approve order ?")
              }) 
      
              $('.decline_pending').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("decline_pending_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(15)
                $('#response_popup').html("Yakin untuk Decline order ?")
                //$("#response_popup").attr("placeholder", "keterangan Decline");
      
              }) 
      
              
      
              $('.return_assign').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("return_assign_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(8)
                // $("#status_popup").val(8)
                $('#response_popup').html("Yakin anda ingin mengembalikan order ?")
              }) 
      
              $('.return_design').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("return_design_","")
      
                $("#id_popup").val(id)
                $("#status_popup").val(11)
                // $("#status_popup").val(8)
                $('#response_popup').html("Yakin untuk mengembalikan order ke inbox desain?")
              }) 
             
              $('.return_go_live').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("return_go_live_","")
      
                $("#id_cancel_return").val(id)
                $("#isi_keterangan_cancel_return").hide()
                $("#status_order_cancel_return").val(12)
                $('#response_cancel_return').html("YakinYakin ingin mereturn order ke INBOX KONSTRUKSI ?")
              }) 
      
              /*$('.assign_live').click(function(){
                
                var atr = $(this).attr("id")
                var id = atr.replace("assign_live_","")
      
                $("#id_assign_live").val(id)
                
              })*/
              
               $('.assign_live').click(function(){
                  // alert('test')
                 var atribut = $(this).attr('id');
                 var id = atribut.replace('assign_live_','')
                 
                 $('#id_done').val(id)
                 //alert(id)
                 console.log('ok')
                 $('#type_done').val("3")
      
              })
      
                $('#btn_delete').click(function(){
                  var id_user = $("#id_user").val()
                  $.post(hostname+"/api/delete_user",{
                    id_user:id_user
                  },function(res,req){  
                    var json = JSON.parse(res)            
                    alert(json.message)
                    window.location.href= hostname+"/user/table/2"
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
      
          $('#clear').click(function(){
              $('#r_calang').hide()
              $('#after_calang').hide()
              $('#r_wo').hide()
              $("#type_order").val('-');
              $('#cek').hide()
      
              $('#wo').val('')
              $('#calang').val('')
          })
          
          $('#btn_search_wo').click(function(){
              var value = $('#txt_search_wo').val()
              window.location.href= hostname+"/table/search/"+value
          })
      
         $('#wo').on('input',function(e){
               var value = $(this).val();
               console.log(value)
               if((!$.isNumeric(value))){
                  $('#warning_number').show()
                  $('#wo').val('')
                  
               }else{
                  $('#warning_number').hide()
               }
          });
          
          $('#date_kategori_other').on('input',function(e){
               var value = $(this).val();
               console.log(value)
               if((!$.isNumeric(value))){
                  $('#date_kategori_other').val('')
               }
          });
      
          $('#validasi_sebelum_popup').click(function(){
           
            var wo = $('#wo').val()
              var nama_calang = $('#calang').val()
              var latitude = $('#latitude').val()
              var longitude = $('#longitude').val()
              var odp = $('#odp').val()
              var alamat = $('#alamat').val()
              var kategori = $('#kategori').val()
              var type = $('#type').val()
              var id = $('#id').val()
              var type_order = $('#type_order').val()
              var date_kategori_other = $('#date_kategori_other').val()
              
            var warning = 0
              if(nama_calang == ""){
                $('#warning_calang').show();
                warning++
              }else{
                $('#warning_calang').hide();
              }
              
              if(kategori == "3"){
                  if(date_kategori_other == ""){
                    $('#warning_date_kategori_other').show();
                    warning++
                  }else{
                    $('#warning_date_kategori_other').hide();
                  }
              }
      
              if(kategori.trim() == "-"){
                  $('#warning_ketegori').show();
                  warning++
              }else{
                  $('#warning_ketegori').hide();
              }
      
              if(latitude == ""){
                  $('#warning_latitude').show();
                  warning++
              }else{
                 $('#warning_latitude').hide();
              }
      
              if(longitude == ""){
                    $('#warning_longitude').show();
                    warning++
              }else{
                 $('#warning_longitude').hide();
              }
      
              if(alamat.trim() == ""){
                  $('#warning_alamat').show();
                  warning++
              }else{
                $('#warning_alamat').hide();
              }
      
               if(kategori != "5"){
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
                        warning++
                        $('#warning_odp').show();
                        return true
                      }
                      
                    }catch(err){
                        warning++
                        $('#warning_odp').show();
                      return true
                    }
              }else{
                odp = "-"
              }
              $('#warning_odp').hide();
      
             
              if(warning == 0){
                  $( "#submit_inputer" ).trigger( "click");
              }
                
          })
      
          $('#submit_inputer_new').click(function(){
              var wo = $('#wo').val()
              var nama_calang = $('#calang').val()
              var latitude = $('#latitude').val()
              var longitude = $('#longitude').val()
              var odp = $('#odp').val()
              var alamat = $('#alamat').val()
              var kategori = $('#kategori').val()
              var type = $('#type').val()
              var id = $('#id').val()
              var type_order = $('#type_order').val()
              var date_kategori_other = $('#date_kategori_other').val()
      
              if(kategori == "5"){
                odp = "-"
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
                date_kategori_other:date_kategori_other,
                type_order:type_order,
                inputer:"{{$id_user}}"
      
              }
      
              console.log(date_kategori_other) 
              
              $.post(hostname+'/api/put_inputer',arr,
              function(res,req){
                  alert("Data Berhasil Tersimpan")
                  window.location.href= hostname+"/inputer"
              })
          })
            
          $('#cek').click(function () {
           
                $('#after_calang').hide()
                $('#validasi_sebelum_popup').hide()
      
                $('#wo').prop( "disabled", false );
                $('#calang').prop( "disabled", false );
                $('#type_order').prop( "disabled", false );
               var type_order = $('#type_order').val()
               var wo = $('#wo').val()
               var calang = $('#calang').val() 
              var warning = 0
               if(wo == ""){
                      $('#warning_wo').show();
                      warning++
                }else{
                    $('#warning_wo').hide();
                }
      
                if(calang == ""){
                      $('#warning_calang').show();
                    warning++
                }else{
                    $('#warning_calang').hide();
                }
                if(type_order.trim() == "-"){
                      $('#warning_type').show();
                    warning++
                }else{
                    $('#warning_type').hide();
                }
      
                if(warning != 0 ){
                  return true
                }
      
                // validasi type order
                if(type_order == "1"){
                    if(!$.isNumeric(wo)){
                       return  alert("Format Harus Angka")
                    }        
                   if((wo.length) < 13){
                     return  alert("MYIR  minimal 13")
                   }
                }else  if(type_order == "2"){
                    if(!$.isNumeric(wo)){
                       return  alert("Format Harus Angka")
                    }    
                   if((wo.length) < 8){
                     return  alert("SC minimal 8 ")
                   }
                }else  if(type_order == "3"){
                    if(!$.isNumeric(wo)){
                       return  alert("Format Harus Angka")
                    }  
                   if((wo.length) < 6){
                     return  alert("IN minimal 6 ")
                   }
                }else  if(type_order == "- Pilih Type -"){
                  return  alert("Pilih Type Order Terlebih Dahulu")
                }
                //----- check validasi
                
                var arr = {
                  wo:wo,
                  calang:calang
                }
                console.log(arr)
                $.post(hostname+'/api/check_inputer',
                  arr
                ,
                function(res,req){
                    console.log(hostname+'/api/check_inputer')
                    var str = JSON.parse(res)
                    console.log("status",str.status)
                    
                    if(str.status){
                      if(str.row > 0){
                         var data_table = str.data
                         var table = '<table class="table table-hover text-nowrap">'+
                                      '<thead>'+
                                        '<tr>'+
                                          '<th>No</th>'+
                                          '<th>MYIR</th>'+
                                          '<th>Nama Calang</th>'+
                                          '<th>Latitude</th>'+
                                          '<th>Longitude</th>'+
                                          '<th>Alamat</th>'+
                                          '</tr>'+
                                      '</thead>'+
                                      '<tbody>';
                               var no = 1       
                               data_table.forEach(function(data){
      
                                  if(no == 1){
                                      table +=  '<tr style="background:#7CFC00">';
                                  } else{
                                      table +=  '<tr>';
                                  }
      
                                  table +=  ''+
                                              '<td>'+no+'</td>'+
                                              '<td>'+data.wo+'</td>'+
                                              '<td>'+data.nama_calang+'</td>'+
                                              '<td>'+data.lat+'</td>'+
                                              '<td>'+data.long+'</td>'+
                                              '<td>'+data.alamat+'</td>'+
                                              '</tr>';
                                  no++       
      
                              })         
                              
                              table += '</table>'
      
                        //---- table ---
                        $('#table_eksisting').html(table)                  
                        $( "#popup" ).trigger( "click");
                        $('#lanjut').click(function(){
                          $('#cek').hide()
                          $('#wo').prop( "disabled", true );
                          $('#calang').prop( "disabled", true );
                          $('#type_order').prop( "disabled", true );
                          
                          $('#after_calang').show()
                          $('#validasi_sebelum_popup').show()
                          $('#cek').hide()
                          
                          /*  
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
                             $('#kategori').html(option);*/
                        })
                      }else{
                          $('#after_calang').show()
                          $('#validasi_sebelum_popup').show()
                          $('#cek').hide()
                      }
                    }else{
                          $('#after_calang').show()
                          $('#validasi_sebelum_popup').show()
                          $('#cek').hide()
                    }
                })
          });
      
          $('#kategori').on('change', function() {
             var odp =  this.value
                if(odp == "5"){
                  $('#l_odp').hide()
                }else{
                   $('#l_odp').show()
                }
                if(odp == "3"){
                  $('#r_date_kategori_other').show()
                }else{
                  $('#r_date_kategori_other').hide()
                }
          });
      
          $('#type_order').on('change', function() {
             var type =  this.value
              $('#wo').val('')
              $('#calang').val('')
                if(type == "-"){
                  $('#r_calang').hide()
                  $('#after_calang').hide()
                  $('#r_wo').hide()
                  $("#type_order").val('-');
                  $('#cek').hide()
                }else if(type == "4"){
      
                  $('#r_wo').hide()
                  $('#cek').hide()
                  
      
                   $('#r_calang').show()
                   $('#after_calang').show()
                   $('#validasi_sebelum_popup').show()
                }else{
                  $('#r_wo').show()
                  $('#r_calang').show()
                  $('#cek').show()

      
                   $('#after_calang').hide()
                   $('#validasi_sebelum_popup').hide()
                }
          });
      
           $('.done_go_live').click(function(){
                
                  var atr = $(this).attr("id")
                  var id = atr.replace("done_go_live_","")
                
                  $("#id_go_live").val(id)
              }) 
      
         $('#btn_save_go_live').click(function(){
               var id = $("#id_go_live").val()
      
                $.post(hostname+'/api/update_status',
              {
                id:id,
                status:"7",
              },
              function(res,req){
                alert("Update Berhasil")
                window.location.href= hostname+"/table/4"
              })
          })    
            /*$('.cancel_kons').click(function(){
                  var win = window.location.href
                  var ar_win = win.split("/")
                  var ar_win_row = ar_win.length  
      
                  var atribut = $(this).attr('id');
                  var id = atribut.replace('cancel_kons_','')
      
                  $.post(hostname+'/api/update_status',
                {
                  id:id,
                  status:"5",
                },
                function(res,req){
                  alert("Update Berhasil")
                  window.location.href= hostname+"/table/3"
                })
            })   */ 
            
            
           $('#update_cancel_pending').click(function(){
      
               var id = $("#id_cancel_pending").val()
               var status =  $("#status_order_cancel_pending").val()
               var keterangan =  $("#isi_keterangan_cancel_pending").val()
               if(keterangan == ""){
                  return alert("Isi Keterangan Terlebih Dahulu")
               }
                var arr = {
                  id:id,
                  status:status,
                  keterangan:keterangan,
                }
                console.log(JSON.stringify(arr))
                  $.post(hostname+'/api/update_status', 
                  arr,
                  function(res,req){
                    alert("Update Berhasil")
                    window.location.href= hostname+"/table/1"
                  })
            }) 
      
            $('#update_cancel_return').click(function(){
      
               var id = $("#id_cancel_return").val()
               var status =  $("#status_order_cancel_return").val()
               var keterangan =  $("#isi_keterangan_cancel_return").val()
               if(status == "11"){
                  keterangan = ""
               }else if(status == "12"){
                  keterangan = ""
               }else{
                 if(keterangan == ""){
                 return alert("Isi Keterangan Terlebih Dahulu")
                }
               }
      
                var ekstensi = "3";
               if(status == "12"){
                  ekstensi = "4"
               }  
               
                var arr = {
                  id:id,
                  status:status,
                  keterangan:keterangan,
                }
                console.log(JSON.stringify(arr))
                  $.post(hostname+'/api/update_status', 
                  arr,
                  function(res,req){
                    alert("Update Berhasil")
                    
                    window.location.href= hostname+"/table/"+ekstensi
                  })
            }) 
      
            $('#update_popup').click(function(){
      
               var id = $("#id_popup").val()
               var status =  $("#status_popup").val()
               var ekstensi = "5"
      
               if(status == "8"){
                  ekstensi = "3"
               }
               
                var arr = {
                  id:id,
                  status:status
                }
                console.log(JSON.stringify(arr))
                  $.post(hostname+'/api/update_status', 
                  arr,
                  function(res,req){
                    alert("Update Berhasil")
                    
                    window.location.href= hostname+"/table/"+ekstensi
                  })
            }) 
           
           
           /*$('.cancel_design').click(function(){
                  var win = window.location.href
                  var ar_win = win.split("/")
                  var ar_win_row = ar_win.length  
      
                  var atribut = $(this).attr('id');
                  var id = atribut.replace('cancel_design_','')
      
                  $.post(hostname+'/api/update_status',
                {
                  id:id,
                  status:"10",
                },
                function(res,req){
                  alert("Update Berhasil")
                  window.location.href= hostname+"/table/1"
                })
            }) */   
      
           
           /* $('.pending_design').click(function(){
                  var win = window.location.href
                  var ar_win = win.split("/")
                  var ar_win_row = ar_win.length  
      
                  var atribut = $(this).attr('id');
                  var id = atribut.replace('pending_design_','')
      
                  $.post(hostname+'/api/update_status',
                {
                  id:id,
                  status:"9",
                },
                function(res,req){
                  alert("Update Berhasil")
                  window.location.href= hostname+"/table/1"
                })
            })*/
      
            $('.done_design').click(function(){
               
                 var atribut = $(this).attr('id');
                 var id = atribut.replace('done_design_','')
                 
                 $('#id_done').val(id)
                 $('#type_done').val('1')
      
            })
            $('.done_kons').click(function(){
               
                 var atribut = $(this).attr('id');
                 var id = atribut.replace('done_kons_','')
                 var time = atribut.replace('time_done_','')
                 
                 $('#id_done').val(id)
                 $('#type_done').val('2')
                 $('#time_done').val(time)
      
            })
      
            $('.done_design').click(function(){
               
                 var atribut = $(this).attr('id');
                 var id = atribut.replace('done_design_','')
                 
                 $('#id_done').val(id)
                 $('#type_done').val('1')
      
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
      
             $('.assign').click(function(){
                  var atribut = $(this).attr('id');
                  var id = atribut.replace('assign_','')
                  $('#id').val(id)
      
                  var id_mitra =  $("#id_mitra_assign_"+id).val() 
      
                  if(id_mitra == ""){
                      id_mitra = "0"
                  }
      
                  $.post(hostname+"/api/get_not_in_mitra",{
                    id:id_mitra
                  },function(json,req){   
                    var option = ""
                    option += "<option value='0'>- Pilih Mitra -</option>"  
                    json.forEach(element => {
                          option += "<option value="+element.id_mitra+">"+element.nama_mitra+" - "+element.alamat+"</option>"        
                    });
                    $("#mitra").html(option)   
                  })
      
      
             })
      
             $('.kendala_kons').click(function(){
                  var atribut = $(this).attr('id');
                  var id = atribut.replace('kendala_kons_','')
                  $('#id').val(id)
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
                  var arr = {
                      id:id,
                      status:"2",
                      mitra:mitra,
                  }
      
                  console.log(JSON.stringify(arr))
      
                  $.post(hostname+'/api/update_status',
                  arr,
                function(res,req){
                  alert("Update Berhasil")
                  window.location.href= hostname+"/table/2"
                })
             })
             $('#btn_save_assign_live').click(function(){
               
      
                  var halaman = $('#jenis_halaman').val()
                  var id = $('#id_assign_live').val()
      
                  var arr = {
                      id:id,
                      status:"2",
                      mitra:"eksisting",
                  }
      
                  console.log(JSON.stringify(arr))
      
                  $.post(hostname+'/api/update_status',
                  arr,
                function(res,req){
                  alert("Update Berhasil")
                  window.location.href= hostname+"/table/2"
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
                  window.location.href= hostname+"/table/3"
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
            
            $('.open_row').click(function(){ 
              if($('.subrow').is(":visible")){
                $('.subrow').hide();
              }else{
                  var atribut = $(this).attr('id');
                  var id = atribut.replace('open_row_','')
      
                  $('#subrow_'+id).show();
              }
               
                  
            })

      
            $('.subrow').click(function(){ 
                  $('.subrow').hide();
            })
            
          });
      
          
        </script>
        <script>
            $(function(){

                // Counter for dashboard stats
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });

                // Welcome notification
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "3500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                //toastr["success"]("One stop solution to your website admin panel!", "Welcome to Options!");

            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
