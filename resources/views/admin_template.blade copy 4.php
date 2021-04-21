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
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
  

	<title>Acak</title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/styles/style.min.css')}}">
	
	<!-- Material Design Icon -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/fonts/material-design/css/materialdesignicons.css')}}">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/plugin/waves/waves.min.css')}}">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/plugin/sweet-alert/sweetalert.css')}}">
	
	<!-- Percent Circle -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/plugin/percircle/css/percircle.css')}}">

	<!-- Chartist Chart -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/plugin/chart/chartist/chartist.min.css')}}">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/plugin/fullcalendar/fullcalendar.min.css')}}">
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/plugin/fullcalendar/fullcalendar.print.css')}}" media='print'>

	<!-- Color Picker -->
	<link rel="stylesheet" href="{{asset('bower_components/light/assets/color-switcher/color-switcher.min.css')}}">
</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo">Acak</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<ul class="menu js__accordion">
				<li class="current">
					<a class="waves-effect" href="{{url('/inputer')}}"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Input</span></a>
				</li>
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-email-outline"></i><span>Inbox</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
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
					<!-- /.sub-menu js__content -->
				</li>
				
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-close"></i><span>Summary</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{url('/table')}}/5">Pending</a></li>
						<li><a href="{{url('/table')}}/6">Cancel </a></li>
						<li><a href="{{url('/table')}}/7">Close</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-chart-bar"></i><span>Report</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{url('/report/mitra/permintaan/1')}}">performansi mitra</a></li>
						<li><a href="{{url('/report/mitra/permintaan/2')}}">rata-rata penyelesaian</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
        @if ($id_locker == "1")
          <li>      
            <a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-buffer"></i><span>User </span><span class="menu-arrow fa fa-angle-down"></span></a>
            <ul class="sub-menu js__content">
              <li><a href="{{url('user/table')}}/1">Approve</a></li>
              <li><a href="{{url('user/table')}}/2">Update</a></li>
            </ul>
            <!-- /.sub-menu js__content -->
          </li>
        @endif
	
				<li>
					<a class="waves-effect" href="{{url('mitra/table')}}"><i class="menu-icon mdi mdi-inbox"></i><span>Mitra</span></a>
				</li>
			</ul>
			<!-- /.menu js__accordion -->
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<!--<div></div><input type="text" class="form-control" style="margin-top:10px;height:30px" />-->
		<!--<h1 class="page-title">Home</h1></div>-->
		<div class="input-group margin-bottom-20" style="width:200px;margin-top:3px">
			<input id="txt_search_wo" type="text" class="form-control" placeholder="Search wo">
			<div class="input-group-btn"><button type="button" id="btn_search_wo" class="btn btn-violet no-border waves-effect waves-light"><i class="fa fa-search text-white"></i></button></div>
			<!-- /.input-group-btn -->
		</div>
		
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">
		<div class="ico-item">
			<a href="#" class="ico-item fa fa-search js__toggle_open" data-target="#searchform-header"></a>
			<form action="#" id="searchform-header" class="searchform js__toggle"><input type="search" placeholder="Search..." class="input-search"><button class="fa fa-search button-search" type="submit"></button></form>
			<!-- /.searchform -->
		</div>
		<!-- /.ico-item -->
		<div class="ico-item fa fa-arrows-alt js__full_screen"></div>
		<!-- /.ico-item fa fa-fa-arrows-alt -->
		<div class="ico-item toggle-hover js__drop_down ">
			<span class="fa fa-th js__drop_down_button"></span>
			<div class="toggle-content">
				<ul>
					<li><a href="#"><i class="fa fa-github"></i><span class="txt">Github</span></a></li>
					<li><a href="#"><i class="fa fa-bitbucket"></i><span class="txt">Bitbucket</span></a></li>
					<li><a href="#"><i class="fa fa-slack"></i><span class="txt">Slack</span></a></li>
					<li><a href="#"><i class="fa fa-dribbble"></i><span class="txt">Dribbble</span></a></li>
					<li><a href="#"><i class="fa fa-amazon"></i><span class="txt">Amazon</span></a></li>
					<li><a href="#"><i class="fa fa-dropbox"></i><span class="txt">Dropbox</span></a></li>
				</ul>
				<a href="#" class="read-more">More</a>
			</div>
			<!-- /.toggle-content -->
		</div>
		<!-- /.ico-item -->
		<a href="#" class="ico-item fa fa-envelope notice-alarm js__toggle_open" data-target="#message-popup"></a>
		<a href="#" class="ico-item pulse"><span class="ico-item fa fa-bell notice-alarm js__toggle_open" data-target="#notification-popup"></span></a>
		<div class="ico-item">
			<img src="http://placehold.it/80x80" alt="" class="ico-img">
			<ul class="sub-ico-item">
				<li><a href="#">Settings</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="{{url('/logout')}}">Log Out</a></li>
			</ul>
			<!-- /.sub-ico-item -->
		</div>
		<!-- /.ico-item -->
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<div id="notification-popup" class="notice-popup js__toggle" data-space="50">
	<h2 class="popup-title">Your Notifications</h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">John Doe</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">10 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Anna William</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">15 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-warning"><i class="fa fa-warning"></i></span>
					<span class="name">Update Status</span>
					<span class="desc">Failed to get available update data. To ensure the please contact us.</span>
					<span class="time">30 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Jennifer</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Michael Zenaty</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">50 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Simon</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">1 hour</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-violet"><i class="fa fa-flag"></i></span>
					<span class="name">Account Contact Change</span>
					<span class="desc">A contact detail associated with your account has been changed.</span>
					<span class="time">2 hours</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Helen 987</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">Yesterday</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Denise Jenny</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">Oct, 28</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Thomas William</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">Oct, 27</span>
				</a>
			</li>
		</ul>
		<!-- /.notice-list -->
		<a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>
<!-- /#notification-popup -->

<div id="message-popup" class="notice-popup js__toggle" data-space="50">
	<h2 class="popup-title">Recent Messages<a href="#" class="pull-right text-danger">New message</a></h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">John Doe</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">10 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Harry Halen</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">15 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Thomas Taylor</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">30 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Jennifer</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Helen Candy</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Anna Cavan</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 hour ago</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-success"><i class="fa fa-user"></i></span>
					<span class="name">Jenny Betty</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 day ago</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Denise Peterson</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 year ago</span>
				</a>
			</li>
		</ul>
		<!-- /.notice-list -->
		<a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>
<!-- /#message-popup -->

@yield('content')

{{--  <div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Static example</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else there</a></li>
							<li class="split"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					<div class="example-content">
						<div class="modal" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Modal title</h4>
									</div>
									<div class="modal-body">
										<p>One fine body&hellip;</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Save changes</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div>
					<!-- /.example-content -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->

			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Bootstrap Modals</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else there</a></li>
							<li class="split"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					<button type="button" class="btn btn-primary margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-1">Standard modal</button>
					<button type="button" class="btn btn-success margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-2">Large modal</button>
					<button type="button" class="btn btn-warning margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-3">Small modal</button>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->

			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Remodal</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else there</a></li>
							<li class="split"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					<button type="button" data-remodal-target="remodal" class="btn btn-primary waves-effect waves-light">Lauch Modal</button>
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-xs-12 -->
		</div>
		<!-- /.row row-inline-block small-spacing -->		
		<footer class="footer">
			<ul class="list-inline">
				<li>2016 © NinjaAdmin.</li>
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</footer>
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
<!-- Modal -->
<div class="modal fade" id="boostrapModal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sunt tempora, aspernatur reprehenderit expedita maxime assumenda molestiae id minus libero soluta? Ex sapiente cum perspiciatis rem deserunt molestias perferendis eum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate impedit perspiciatis quae et consequuntur fugiat nostrum rem officiis omnis quo, assumenda maxime, praesentium quas, dolore ipsum. Cum nesciunt, maxime tempora.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="boostrapModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-1">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel-1">Modal title</h4>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sunt tempora, aspernatur reprehenderit expedita maxime assumenda molestiae id minus libero soluta? Ex sapiente cum perspiciatis rem deserunt molestias perferendis eum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate impedit perspiciatis quae et consequuntur fugiat nostrum rem officiis omnis quo, assumenda maxime, praesentium quas, dolore ipsum. Cum nesciunt, maxime tempora.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="boostrapModal-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-2">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel-2">Modal title</h4>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In, sunt tempora, aspernatur reprehenderit expedita maxime assumenda molestiae id minus libero soluta? Ex sapiente cum perspiciatis rem deserunt molestias perferendis eum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate impedit perspiciatis quae et consequuntur fugiat nostrum rem officiis omnis quo, assumenda maxime, praesentium quas, dolore ipsum. Cum nesciunt, maxime tempora.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary btn-sm waves-effect waves-light">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="remodal" data-remodal-id="remodal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
	<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
	<div class="remodal-content">
		<h2 id="modal1Title">Remodal</h2>
		<p id="modal1Desc">
		Responsive, lightweight, fast, synchronized with CSS animations, fully customizable modal window plugin
		with declarative state notation and hash tracking.
		</p>
	</div>
	<button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
	<button data-remodal-action="confirm" class="remodal-confirm">OK</button>
</div>  --}}
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="{{asset('bower_components/light/assets/script/html5shiv.min.js')}}"></script>
		<script src="{{asset('bower_components/light/assets/script/respond.min.js')}}"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{asset('bower_components/light/assets/scripts/jquery.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/scripts/modernizr.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/plugin/nprogress/nprogress.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/plugin/waves/waves.min.js')}}"></script>
	<!-- Full Screen Plugin -->
	<script src="{{asset('bower_components/light/assets/plugin/fullscreen/jquery.fullscreen-min.js')}}"></script>

	<!-- Google Chart -->
	{{--  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js')}}"></script>  --}}

	<!-- chart.js Chart -->
	<script src="{{asset('bower_components/light/assets/plugin/chart/chartjs/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/scripts/chart.chartjs.init.min.js')}}"></script>

	<!-- FullCalendar -->
	<script src="{{asset('bower_components/light/assets/plugin/moment/moment.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/plugin/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/scripts/fullcalendar.init.js')}}"></script>

	<!-- Sparkline Chart -->
	<script src="{{asset('bower_components/light/assets/plugin/chart/sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/scripts/chart.sparkline.init.min.js')}}"></script>

	<script src="{{asset('bower_components/light/assets/scripts/main.min.js')}}"></script>
	<script src="{{asset('bower_components/light/assets/color-switcher/color-switcher.min.js')}}"></script>
  <script src="{{asset('bower_components/light/assets/plugin/nprogress/nprogress.js')}}"></script>
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
           
           $('#id_done').val(id)
           $('#type_done').val('2')

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
<input type="text" hidden id="id_user_real" value="{{$id_locker}}" />
</body>

</html>