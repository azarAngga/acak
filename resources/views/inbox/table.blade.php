@extends('admin_template')
@php
     $localhost = str_replace(":8000","","http://".$_SERVER['HTTP_HOST']."/acak/");
    
     $now =  Date('Y-m-d H:i:s');
     function getTime($date1){
      $open_date = $date1;

      $date =  Date('Y-m-d H:i:s');
      $start_date = new DateTime($open_date);

      $since_start = $start_date->diff(new DateTime($date));

      $minutes = $since_start->days * 24 * 60;
      $minutes += $since_start->h * 60;
      $minutes += $since_start->i;

        return $minutes;
    }

    function getDiffTwoDate($date1,$date2){
      $start_date = new DateTime($date1);
      $since_start = $start_date->diff(new DateTime($date2));
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



{{-- header --}}
@section('header')
    Table Inbox
@endsection
{{-- end header --}}


{{-- menu title --}}
@section('menu_title')
    <li class="breadcrumb-item"><a href="#">Table User</a></li>
@endsection
{{-- end menu title --}}

{{-- content --}}
@section('content')

<style>
.table_expand { 
  font-size:8pt
}
</style>


<div class="col-md-12">
  <div class="panel">
      <div class="panel-heading">
          <div class="panel-title">
          </div>
      </div>
      <div class="panel-body">
        <h4>INBOX {{$label}}</h4>
        <hr/>
        <table class="table table-hover text-nowrap" >
         <thead>
           <tr>
             <th>NO</th>
             <th>ORDER ID</th>
             <th>NAMA CALANG</th>
             
             @if ($jenis_halaman != "5" && $jenis_halaman != "6" && $jenis_halaman != "7")
                 <th>TIME LIMIT</th>     
             @endif
             
             <th>KATEGORI</th>
             <th>STATUS</th>
             
             @if($jenis_halaman == "3" || $jenis_halaman == "4" )
                 <th>FILE KML</th>    
                 <th>FILE XLSX</th> 
             @endif
             <th>ACTION
             </th>
           </tr>
         </thead>
         <tbody>
       
           @foreach ($data as $index => $item)
             <tr>
               
               <td>{{$index+1}} </td>
               <td>{{($item->wo)}}</td>
               <td><a href="#" id="open_row_{{$item->id}}" class="open_row">{{$item->nama_calang}}</a></td>
               @if ($jenis_halaman != "5" && $jenis_halaman != "6" && $jenis_halaman != "7")
                 <td>
                 @php
                 // halaman 3 tapi belum di accept
                  if($jenis_halaman == "3" && $item->status == "2"){
                    $date_used = 0;
                    $date_all = 0;
                  }else{
                  // halaman 3
                  
                    $date_used = getDiffTwoDate($item->last_update,$now);
                    $date_all = getDiffTwoDate($item->last_update,$item->target_selesai);
                  }
                    
                    try{
                      $hasil_date = intval(($date_used/$date_all)*100);
                      if($hasil_date > 100){
                         $hasil_date = 100;
                      }
                    }catch(Exception $e){
                      $hasil_date = 0;
                    }

                 @endphp
                 <div class="progress">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{$hasil_date}}%">
                <div style="width:20px;color:#808080"><span >&nbsp;{{$hasil_date}}%</span></div>
                  </div>
                  </div>
                </td>
               @endif      
               <td>{{$m_kategory_order->KategoriById($item->id_categori_order)[0]->deskripsi}}</td>
               @if($jenis_halaman == '7' && $item->id_categori_order == "5")
                <td>CLOSED</td>
               @elseif($jenis_halaman == '7' && $item->id_categori_order != "5")    
                 <td>GO LIVE</td>
               @else
                 <td>
                   @if($item->status != null)
                     {{$m_status_order->getStatusOrderFromId($item->status)}}
                   @else
                     -
                   @endif
                  
                 </td>    
               @endif
                @if ($jenis_halaman == "5")
                   <td>{{$item->keterangan_pending}}</td>
                @endif
                @if ($jenis_halaman == "6")
                   <td>{{$item->keterangan_cancel}}</td>
                @endif
                @if($jenis_halaman == "3" || $jenis_halaman == "4" )
                  @php
                   if($jenis_halaman == "3"){
                     $status_file = "8";
                   }else{
                     $status_file = "4";
                   }

                   $kml = $m_attach_file->getFile($item->id,1,$status_file);
                   $xls = $m_attach_file->getFile($item->id,2,$status_file);

                   
                  @endphp
                  @if (count($kml) > 0 && count($xls) > 0)
                         <td><a href="<?php echo $localhost;?>upload/{{$m_attach_file->getFile($item->id,1,$status_file)}}"> <i class="menu-icon mdi mdi-file"></i></a></td>    
                         <td><a href="<?php echo $localhost;?>upload/{{$m_attach_file->getFile($item->id,2,$status_file)}}"> <i class="menu-icon mdi mdi-file"></i></a></td>  
                  @else
                       <td>-</td>    
                       <td>-</td> 
                  @endif
                    
                 @endif  
                 
                  <td>

                     <table padding>
                       <tr>
                         @if($jenis_halaman == "1" )
                            
                           @if($item->status == 0)
                              <td><button id="done_design_{{$item->id}}" type="button"  data-toggle="modal" data-target="#modal-done" class="done_design btn btn-block btn-success btn-xs">DONE</button></td>
                             <td><button id="pending_design_{{$item->id}}" data-toggle="modal" data-target="#modal-cancel-pending" type="button" class="pending_design btn btn-block btn-warning btn-xs">PENDING</button></td>
                             <td><button id="cancel_design_{{$item->id}}" data-toggle="modal" data-target="#modal-cancel-pending" type="button" class="cancel_design btn btn-block btn-danger btn-xs">CANCEL</button></td>
                       
                           @else
                             <td><button id="assign_live_{{$item->id}}" type="button"  data-toggle="modal" data-target="#modal-done" class="assign_live btn btn-block btn-success btn-xs">ASSIGN</button></td>
                             <!--<td><button id="assign_live_{{$item->id}}" type="button"  data-toggle="modal" data-target="#modal-mitra-question" class="assign_live btn btn-block btn-success btn-xs">ASSIGN</button></td>-->
                           @endif
                          
                             
                         @endif  

                         @if($jenis_halaman == "2" )
                           @if ($item->status == "8")
                            <td><button id="assign_{{$item->id}}" type="button"  data-toggle="modal" data-target="#modal-mitra" class="assign btn btn-block btn-success btn-xs">ASSIGN</button></td>
                           
                           @endif
                           
                           <input type="hidden"   id="id_mitra_assign_{{$item->id}}" value="{{$item->id_mitra}}" />
                           
                         @endif 

                         @if($jenis_halaman == "3" )
                         <td><button id="accept_kons_{{$item->id}}" type="button" 
                               @if ($item->status == "21")
                                style="display:none"
                                @else
                                style="display:block"
                               @endif
                            class="accept_kons btn btn-block btn-primary btn-xs">ACCEPT</button></td>
                           
                           <td> 
                            <button id="done_kons_{{$item->id}}" type="button"  data-toggle="modal" data-target="#modal-done" class="done_kons accept btn btn-block btn-success btn-xs" 
                              @if ($item->status == "21")
                              style="display:block"
                              @else
                                style="display:none"
                              @endif>FINISH</button></td>
                           <td><button 
                             @if ($item->status == "12")
                                   disabled
                             @endif
                             id="kendala_kons_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-kendala" class="kendala_kons accept btn btn-block btn-warning btn-xs"
                          
                             @if ($item->status == "21")
                             style="display:block"
                             @else
                               style="display:none"
                              @endif
                              >PENDING</button></td>
                           <td><button 
                              @if ($item->status == "12")
                                   disabled
                             @endif
                              id="cancel_kons_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-cancel-return" class="cancel_kons accept btn btn-block btn-danger btn-xs" 
                              @if ($item->status == "21")
                                  style="display:block"
                              @else
                                style="display:none"
                              @endif
                           >CANCEL</button></td>

                           <td><button 
                             @if ($item->status == "12")
                                  disabled
                            @endif
                            @if ($item->status == "21")
                                  style="display:block"
                              @else
                                style="display:none"
                              @endif
                          id="return_design_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup" class="return_design accept btn btn-primary  btn-xs" style="display:none">RETURN DESIGN</button></td>

                           <td><button 
                              @if ($item->status == "12")
                                   disabled
                             @endif
                             @if ($item->status == "21")
                             style="display:none"
                             @else
                               style="display:block"
                             @endif
                           id="return_assign_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup" class="return_assign btn btn-block  btn-xs">DECLINE</button></td>
                         
                         @endif  

                          @if($jenis_halaman == "4" )
                             <td><button id="done_go_live_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-go-live-question"  class="done_go_live btn btn-block btn-success btn-xs">DONE</button></td>
                             <td><button id="return_go_live_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-cancel-return" class="return_go_live btn btn-block  btn-xs">RETURN</button></td>
                           @endif   

                            @if($jenis_halaman == "5" )
                             
                               @if($item->status == "3" )
                                 <td><button id="approve_pending_kons_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="approve_pending_kons btn btn-block btn-success btn-xs">APPROVE</button></td>   
                               @endif

                               @if($item->status == "9" )
                                 <td><button id="approve_pending_design_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="approve_pending_design btn btn-block btn-success btn-xs">APPROVE</button></td>
                               @endif

                               @if($item->status == "14" )
                                 <td><button id="resume_pending_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="resume_pending btn btn-block btn-success btn-xs">RESUME ORDER</button></td>
                               @endif

                               @if($item->status == "9" )
                                 <td><button id="decline_pending_design_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="decline_pending_design btn btn-block btn-block btn-xs">DECLINE</button></td>
                               @endif
                               @if($item->status == "3"  )
                                 <td><button id="decline_pending_kons_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="decline_pending btn btn-block btn-block btn-xs">DECLINE</button></td>
                               @endif
                               
                           @endif 

                           @if($jenis_halaman == "6" )
                             
                               @if($item->status == "10" )
                                 <td><button id="approve_cancel_design_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="approve_cancel_design btn btn-block btn-success btn-xs">APPROVE</button></td>  
                                 <td><button id="decline_cancel_design_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="decline_cancel_design btn btn-block btn-block btn-xs">DECLINE</button></td>
                               @endif

                               @if($item->status == "5")
                                 <td><button id="approve_cancel_kons_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="approve_cancel_kons btn btn-block btn-success btn-xs">APPROVE</button></td>  
                                 <td><button id="decline_cancel_kons_{{$item->id}}" type="button" data-toggle="modal" data-target="#modal-popup"  class="decline_cancel_kons btn btn-block btn-block btn-xs">DECLINE</button></td>
                               @endif
                               
                           @endif   
                           
                            @if($jenis_halaman == "7" )
                            <td>-</td>
                            @endif   

                       </tr>
                     </table>
                  </td>
             </tr>
             <tr>
              <td colspan="9" class="subrow" id="subrow_{{$item->id}}" style="background:#008000;display:none">
                <table class="table_expand table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ORDER ID</th>
                      <th>NAMA CALANG</th>
                      <th>LATITUDE</th>
                      <th>LONGITUDE</th>
                      <th>ALAMAT</th>
                      <th>NAMA ODP</th>
                      <th>INPUTER</th>
                      @if($jenis_halaman == '3')
                      <th>Nama Mitra</th>
                      @endif
                      <th>TGL CREATE</th>
                      <th>KATEGORI</th>
                      <th>STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>{{($item->wo)}}</td>
                        <td>{{$item->nama_calang}}</td>
                        <td>{{$item->lat}}</td>
                        <td>{{$item->long}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->nama_odp}}</td>
                        <td>
                          @if($item->inputer != NULL)
                          {{$m_user->getUserFromId($item->inputer)['nama']}}
                          @endif
                        </td>
                          @if($jenis_halaman == '3')
                            <td>{{$m_mitra->getMitra($item->id_mitra)[0]->nama_mitra}}</td>
                          @endif
                        <td>{{$item->create_dtm}}</td>
                        <td>{{$m_kategory_order->KategoriById($item->id_categori_order)[0]->deskripsi}}</td>
                        @if($jenis_halaman == '7' && $item->id_categori_order == "5")
                          <td>CLOSED</td>
                        @elseif($jenis_halaman == '7' && $item->id_categori_order != "5")    
                          <td>GO LIVE</td>
                        @else
                        <td>
                          @if($item->status != null)
                            {{$m_status_order->getStatusOrderFromId($item->status)}}
                          @endif
                            -
                        </td>    
                        @endif
                        
                        
                      </tr>  
                  </tbody>
                </table>
              </td>
             </tr>
           @endforeach   
         </tbody>
        </table>
      </div>
  </div>
</div>
<!-- /.col-md-6 -->

<form action="{{$localhost}}upload.php" method="post" enctype="multipart/form-data">

    <div class="modal fade" id="modal-done">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><div style="float:left"> Silahkan upload data Desain dan BoQ <div></h4>
              
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <b>Desain (.kml) <span style="font-size:5pt"><span style="color:red" >*</span> maks 5mb </span></b>
            <input type="file" name="file" accept=".kml" class="form-control" /> 
            <b>BoQ (.xls/xlsx) <span style="font-size:5pt"><span style="color:red" >*</span> maks 5mb </span></b>
            <input type="file" name="file2" accept=".xlsx" class="form-control" />
            
            <input type="hidden"  id="id_done" name="id_done" />
            <input type="hidden"  id="type_done" name="type_done" />
            <input type="hidden"  id="time_done" name="time_done" />
          </div>
          <div class="modal-footer justify-content-between">
          
           <input type="submit" class="btn btn-primary" value="Upload"/>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>

<div class="modal fade" id="modal-mitra">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><div style="float:left">Pilih Nama Mitra &nbsp;</div><div style="float:left" id="status"><div></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
            <select class="form-control"  id="mitra">

                  <option>- Pilih Mitra -</option>
                  
                  {{-- @foreach ($mitra as $item)
                  <option value="{{$item->id_mitra}}">{{$item->nama_mitra}}</option>
                  @endforeach --}}
                </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" id="btn_save_done" class="btn btn-primary">OK</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-mitra-question">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><div style="float:left">yakin untuk mengubah status menjadi INSTALATION ?<div></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input id="id_assign_live" type="hidden"  placeholder="isi di sini"/>
        <div class="modal-footer justify-content-between">
          <button type="button" id="btn_save_assign_live" class="btn btn-primary">OK</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-go-live-question">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><div style="float:left">yakin untuk mengubah status menjadi Done ?<div></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <input id="id_go_live" type="hidden"  placeholder="isi di sini"/>
        <input id="status_order_go_live" type="hidden"  placeholder="isi di sini"/>
        <div class="modal-footer justify-content-between">
          <button type="button" id="btn_save_go_live" class="btn btn-primary">OK</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-cancel-pending">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><div style="float:left">&nbsp;</div><div style="float:left" id="response"> ?<div></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div  class="modal-body">
          <div>
            <textarea row="5" id="isi_keterangan_cancel_pending" class="form-control"></textarea>
            <input id="id_cancel_pending" type="hidden"  placeholder="isi di sini"/>
            <input id="status_order_cancel_pending" type="hidden"  placeholder="isi di sini"/>
          </div>
        </div>
          
      <div class="modal-footer justify-content-between">
        <button type="button" id="update_cancel_pending" class="btn btn-primary">Update</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-cancel-return">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><div style="float:left">&nbsp;</div><div style="float:left" id="response_cancel_return"> ?<div></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div  class="modal-body">
          <div>
            <textarea row="5" id="isi_keterangan_cancel_return" placeholder="Keterangan" class="form-control"></textarea>
            <input id="id_cancel_return" type="hidden"  placeholder="isi di sini"/>
            <input id="status_order_cancel_return" type="hidden"  placeholder="isi di sini"/>
          </div>
        </div>
          
      <div class="modal-footer justify-content-between">
        <button type="button" id="update_cancel_return" class="btn btn-primary">Yakin</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-popup">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><div style="float:left">&nbsp;</div><div style="float:left" id="response_popup"><div></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div  >
          <div>
            <input id="id_popup" type="hidden"  placeholder="isi di sini"/>
            <input id="status_popup" type="hidden"  placeholder="isi di sini"/>
          </div>
        </div>
          
      <div class="modal-footer justify-content-between">
        <button type="button" id="update_popup" class="btn btn-primary">ok</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-kendala">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><div style="float:left">Isi Kendala &nbsp;</div><div style="float:left" id="status"><div></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <textarea row="5" id="isi_kendala" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" id="btn_save_kendala" class="btn btn-primary">Save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<input type="hidden" id="id" name="id" />
@endsection
{{-- end content --}}



