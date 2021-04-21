@php
    $version = $m_versions->getData();

     function getTime($date1){
      $open_date = $date1;

      $date =  Date('Y-m-d h:i:s');
      $start_date = new DateTime($open_date);

      $since_start = $start_date->diff(new DateTime($date));
      

      $minutes = $since_start->days * 24 * 60;
      $minutes += $since_start->h * 60;
      $minutes += $since_start->i;

        return $minutes;
    }


    function textLong($text){

      if(strlen($text) > 50){
        $text = substr($text,0,50);
        $text =  $text.".....";
      }
      //echo substr("Hello world",6);


      return $text;
    }
@endphp
@extends('admin_template')


{{-- header --}}
@section('header')
    Table User
@endsection
{{-- end header --}}


{{-- menu title --}}
@section('menu_title')
    <li class="breadcrumb-item"><a href="#">Table User</a></li>
@endsection
{{-- end menu title --}}

{{-- content --}}
@section('content')

<div class="row" style="
  overflow-y: scroll;">
    <div class="col-12">
      <div class="card" >
        
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 frame" style="
      
  width: 100%;
  height: 600px;
  overflow-x: scroll;">
            {{-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                Launch Default Modal
              </button> --}}
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Open</th>
                <th>Durasi</th>
                <th>User</th>
                <th>Type</th>
                <th>Locker</th>
                <th>Eksekutor</th>
                <th>MYIR</th>
                <th>Email</th>
                <th>ODP</th>
                <th>PORT</th>
                <th>Message</th>
                <th>Status</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $index => $item)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{($item->open_date)}}</td>
                  <td>
                    @if (isset($item->durasi))
                      {{$item->durasi}}
                    @else
                      {{getTime($item->open_date)}}
                    @endif
                  </td>
                  <td>
                    {{$m_user->getUserFromId($item->id_requester)['user_telegram']}}
                  </td>
                  <td>
                    {{$m_type_order->getTypeOrder($item->id_type_order)}}
                  </td>
                  <td>
                      @if (isset($item->id_requester))
                        {{$m_locker->getLockerFromId($m_user->getUserFromId($item->id_requester)['id_locker'])}}
                        @else
                        -
                      @endif
                  </td>
                  <td>
                  
                    @if (isset($item->id_eksekutor))
                      {{$m_user->getUserFromId($item->id_eksekutor)['user_telegram']}}    
                    @else
                      -
                    @endif
                  </td> 
                  <td>
                    @if (isset($item->myir))
                      <div id="myir_{{$item->id_order}}">{{$item->myir}}</div>
                    @else 
                      <div id="myir_{{$item->id_order}}">-</div>
                    @endif
                    
                  </td>
                  <td>
                      @if (isset($item->email))
                      {{$item->email}}    
                    @else 
                      -  
                    @endif
                  </td>
                  <td>
                    @if (isset($item->odp))
                      {{$item->odp}}    
                    @else 
                      -  
                    @endif
                  </td>
                  <td>
                    @if (isset($item->port))
                      {{$item->port}}    
                    @else 
                      -  
                    @endif
                  </td>
                  <td id="td_{{$item->id_order}}" data-toggle="modal" data-target="#modal-message" class="message">
                  
                    @if (isset($item->message))
                      <input type="hidden" id="message_{{$item->id_order}}" value="{{$item->message}}"/>
                      <?php echo textLong($item->message); ?>   
                    @else 
                      -  
                    @endif
                  </td>
                  <td>{{$m_status_order->getStatusOrderFromId($item->id_status_order)}}</td>
                  <td>
                    <table style="margin-top:-12px">
                      <tr>
                        @if ($item->id_status_order == 1)
                          <td><button id="ogp_{{$item->id_order}}" type="button" class="ogp btn btn-block btn-success btn-xs">CEK</button></td>
                        @endif

                        @if ($item->id_status_order > 1 || $item->id_status_order < 6)
                              
                            @if ($item->id_status_order == 2 || $item->id_status_order == 3)
                              <td><button id="return_{{$item->id_order}}" data-toggle="modal" data-target="#modal-default" type="button" class="return btn btn-block btn-danger btn-xs">RETURN</button></td>
                              <td><button id="close_{{$item->id_order}}" data-toggle="modal" data-target="#modal-default" type="button" class="close_ btn btn-block btn-primary btn-xs">CLOSE</button></td>
                            @endif

                            @if ($item->id_status_order != 2 && $item->id_status_order == 3) 
                              <td><button id="pending_{{$item->id_order}}" data-toggle="modal" data-target="#modal-default" type="button" class="pending btn btn-block btn-warning btn-xs">PENDING</button></td>
                            @endif
                         
                          
                        @endif

                  
                        @if ( $item->id_status_order  > 1 && $item->id_status_order  < 4)
                            <td><button id="fu_{{$item->id_order}}" type="button" class="fu btn btn-block btn-success btn-xs">NEED FU</button></td>
                        @endif

                        @if ($item->id_status_order  > 3)
                            -
                        @endif

                       
                        
                      </tr>
                    </table>
                  </td>
                </tr>    
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  {{-- hidden --}}
  <input type="hidden" id="id_user" value="{{$id_user}}" />

  <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><div style="float:left">Isi Note Anda untuk status &nbsp;</div><div style="float:left" id="status"><div></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <textarea cols="5" id="note" type="text" class="form-control" placeholder="isi di sini"></textarea>
              <input id="status_order" type="hidden" class="form-control" placeholder="isi di sini"/>
              <input id="id_order" type="hidden" class="form-control" placeholder="isi di sini"/>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" id="btn_save" class="btn btn-primary">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <div class="modal fade" id="modal-message">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><div style="float:left">Message &nbsp;</div><div style="float:left" id="status"><div></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           
            <div id="label_message"></div>
              
          </div>
          <div class="modal-footer justify-content-between">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
   
<!-- <script src="js/app.js"></script> -->
<script >

      var version_old = <?= $version ?>

      function test(){
        alert("Ada Data Baru, Yuk Di Reload Dulu :)")
        // sleep(1000).then(() => {
          window.location.href = "/tableOrder"
        // })
        // var r = confirm("Ada Data Baru, Yuk Di Reload Dulu :)");
        // if (r == true) {
          // window.location.href = "/tableOrder"
        // } else {

        // }
      }

      reload()

      function reload(){

        setTimeout(() => {

          var hostname = location.host;
          hostname = "http://"+hostname

          var request = new XMLHttpRequest()

          // Open a new connection, using the GET request on the URL endpoint
          request.open('GET', hostname+'/api/get_versions', true)
          
          request.onload = function () {
            let version_new = request.response
          // alert(request)
            // Begin accessing JSON data here
            // alert(request.status);
            
            if(version_new == version_old){
              reload()
            } else{
              alert("Ada Data baru Yuk Refresh :)")
              
              setTimeout(() => {
                window.location.href = hostname+"/tableOrder"
              },5000);
            }
          }
          request.send()
        }, 3000);
      }

      


    </script>
@endsection
{{-- end content --}}



