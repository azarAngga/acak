@php
     $localhost = "http://localhost/p21/";
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
                <th>MYIR</th>
                <th>Nama Calang</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Alamat</th>
                <th>Nama ODP</th>
                <th>Inputer</th>
                <th>Date create</th>
                <th>Katagori</th>
                <th>status</th>
                @if($jenis_halaman == "2")
                    <td>File</td>    
                @endif
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $index => $item)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{($item->wo)}}</td>
                  <td>{{$item->nama_calang}}</td>
                  <td>{{$item->lat}}</td>
                  <td>{{$item->long}}</td>
                  <td>{{$item->alamat}}</td>
                  <td>{{$item->nama_odp}}</td>
                  <td>{{$m_user->getUserFromId($item->inputer)['nama']}}</td>
                  <td>{{$item->create_dtm}}</td>
                  <td>{{$m_kategory_order->KategoriById($item->id_categori_order)[0]->deskripsi}}</td>
                  <td>{{$m_status_order->getStatusOrderFromId($item->status)}}</td>
                @if($jenis_halaman == "2")
                    <td><a href="<?php echo $localhost;?>upload/{{$item->nama_file}}"> <i class="nav-icon far fa-file"></i></a></td>    
                @endif 
              
                 
               <td>
                    <table style="margin-top:-12px">
                      <tr>
                      @if($jenis_halaman == "1"  || $jenis_halaman == "2")
                         @if($jenis_halaman == "1" )
                           <td><button id="eko_{{$item->id}}" type="button" class="eko btn btn-block btn-primary btn-xs">EKO</button></td>
                         @endif
                           <td><button id="done_{{$item->id}}" type="button" 
                           @if ($jenis_halaman == "2" && $item->status == "1")
                               data-toggle="modal" data-target="#modal-default"
                           @endif

                          @if ($jenis_halaman == '1' && $item->status == "0")
                              data-toggle="modal" data-target="#modal-done" class="done btn btn-block btn-success btn-xs"
                          @else
                               class="set_id btn btn-block btn-success btn-xs"
                           @endif
                           >DONE</button></td>
                      @endif
                      
                      @if ($jenis_halaman == "3" )
                        <td><button id="kendala_{{$item->id}}" data-toggle="modal" data-target="#modal-kendala" type="button" class="kendala set_id btn btn-block btn-warning btn-xs">KENDALA</button></td>  
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

  <input id="jenis_halaman" value="{{$jenis_halaman}}" hidden />

  {{-- hidden --}}
  <input type="hidden" id="id_user" value="{{$id_user}}" />
  <input type="hidden" id="id" value="" />
  <div class="modal fade" id="modal-default">
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
                    @foreach ($mitra as $item)
                    <option value="{{$item->id_mitra}}">{{$item->nama_mitra}}</option>
                    @endforeach
                  </select>


            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" id="btn_save_done" class="btn btn-primary">Save</button>
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

<form action="<?php echo $localhost ?>/upload.php" method="post" enctype="multipart/form-data">

    <div class="modal fade" id="modal-done">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><div style="float:left"> wajib upload file ekstensi .kml sama .xls/xlsx <div></h4>
              
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="file" name="file" />
            <input type="text" hidden id="id_done" name="id_done" />
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

  <div class="modal fade" id="modal-default">
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
                    @foreach ($mitra as $item)
                    <option value="{{$item->id_mitra}}">{{$item->nama_mitra}}</option>
                    @endforeach
                  </select>


            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" id="btn_save_done" class="btn btn-primary">Save</button>
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
   



@endsection
{{-- end content --}}



