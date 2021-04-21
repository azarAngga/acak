<style>
td{
    text-align: center;
    padding:5px;
}
    </style>
@php
    $label = "";
    if($jenis_page == "1"){
        $label = "Performansi Mitra";
    }else if($jenis_page == "2"){
        $label = "Rata-rata Penyelesaian";
    }else{
        $label = "Custome Query Report";
    }
    
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
  
@endsection
{{-- end header --}}


{{-- menu title --}}
@section('menu_title')
    <li class="breadcrumb-item"><a href="#">Table User</a></li>
@endsection
{{-- end menu title --}}

{{-- content --}}
@section('content')


@php
    $stat = $m_status_order->StatusOrder();
@endphp



<div class="col-md-12">
  <div class="panel">
      <div class="panel-heading">
          <div class="panel-title">
          </div>
      </div>
      <div class="panel-body">
        <label hidden>Search Date Start :</label>
        <div hidden class="input-group" style="width: 30%">
            
            <div hidden class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input hidden type="date" class="form-control float-right" id="date_start" >
          </div>
          <br/>
          <label hidden>Search Date End :</label>
           <div hidden class="input-group" style="width: 30%">
            
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="date" class="form-control float-right" id="date_end">
          </div>

          <br/>
          <button hidden id="filter_pivot" class="btn btn-primary">Filter</button>
          <br/>
          <br/>

          <table border="1" width="100%" padding="2px">
              
            <tr>
              <td rowspan="2">No</td>
              <td rowspan="2"><?=$label?></td>
              <td colspan="{{count($stat)}}">Status</td>
            </tr>
              <tr>
                  @foreach ($stat as $i)
                  <td >{{$i->deskripsi}}</td>
                  @endforeach
              </tr>
            </thead>
          <tbody>
            @foreach ($data as $index => $item)
              <tr>
                <td>{{$index+1}}</td>
                
                {{-- Performansi & rata --}}
                <td>
                    {{$item->nama_mitra}}
                </td>
                
                
                @if($jenis_page == "1")

                    {{-- data Performansi --}}
                    @foreach ($stat as $i)
                        <td>
                            {{ $m_orders->getPivotMitra($item->id_mitra,$i->id_status_order)}}
                        </td>
                    @endforeach
                    
                @endif

                @if($jenis_page == "2")

                {{-- data rata rata --}}
                @foreach ($stat as $i)
                    <td>
                        {{ $m_orders->getAverage($item->id_mitra,$i->id_status_order)}}
                    </td>
                @endforeach
                
            @endif
                </td>
              </tr>    
            @endforeach
          </tbody>
        </table>
        <br/>
        @if ($date1 == "")
            @if($jenis_page == "eksekutor")
                {{-- <a href="{{url('/export/eksekutor')}}"   <button id="filter_pivot" class="btn btn-success">Export Excel</button></a> --}}
            @else
                {{-- <a href="{{url('/export/permintaan')}}"   <button id="filter_pivot" class="btn btn-success">Export Excel</button></a> --}}
            @endif
           
        @else
            @if($jenis_page == "eksekutor")
                {{-- <a href="{{url('/export/eksekutor'.$date1.'/'.$date2)}}"   <button id="filter_pivot" class="btn btn-success">Export Excel</button></a> --}}
            @else
                {{-- <a href="{{url('/export/permintaan/'.$date1.'/'.$date2)}}"   <button id="filter_pivot" class="btn btn-success">Export Excel</button></a> --}}
            @endif  
        @endif

      </div>
  </div>
</div>
<!-- /.col-md-6 -->


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
    
@endsection
{{-- end content --}}



