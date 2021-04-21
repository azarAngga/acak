@extends('admin_template')


{{-- header --}}
@section('header')
    Input
@endsection
{{-- end header --}}


{{-- menu title --}}
@section('menu_title')
    <li class="breadcrumb-item"><a href="#">Table</a></li>
    <li class="breadcrumb-item"><a href="#">user</a></li>
@endsection
{{-- end menu title --}}

{{-- content --}}
@section('content')
@php
  $d =  date('Y-m-d');
  $now_inputer = date('Y-m-d',strtotime($d.'+ 1 days'));
@endphp

  <div class="col-md-12">
      <div class="panel">
          <div class="panel-heading">
              <div class="panel-title">
                
              </div>
          </div>
          <div class="panel-body">
            <div class="card-body">
              <div class="form-group">
                    <label for="exampleInputPassword1">Type Order <span style="color:red" >*</span><span style="color:red;display:none" id="warning_type" >Pilih Type Order</span></label>
                    <select class="form-control"  id="type_order">
                      <option value="-">- Pilih Type -</option>
                      @foreach ($data_type_order as $item)

                      <option value="{{$item->id_type_order}}">{{$item->deskripsi}}</option>
                      @endforeach
                    
                    </select>
                  </div>
                <div id="r_wo" class="form-group" style="display:none">
                  <label for="exampleInputEmail1">MYIR / SC / IN <span style="color:red" >*</span><span style="color:red;display:none" id="warning_wo" >Harus Angka</span></label>
                  <input type="number" class="form-control" id="wo"  placeholder="MYRI / SC / IN">
                </div>
                
                
                <div id="r_calang" class="form-group" style="display:none">
                  <label for="exampleInputPassword1">Nama Calang <span style="color:red" >*</span><span style="color:red;display:none" id="warning_calang" >Nama Calang Harus Terisi</span></label>
                  <input type="text" class="form-control" id="calang"  placeholder="Nama Calang">
                </div>
      
                
                <div id="after_calang" style="display:none">
                  <div class="form-group">
                    <label for="exampleInputPassword1">Kategori <span style="color:red" >*</span><span style="color:red;display:none" id="warning_ketegori_" >Pilih Kategori</span></label>
                    <select class="form-control"  id="kategori">
                      <option value="-">- Pilih Kategori -</option>
                      @foreach ($m_kategory_order as $item)

                      <option value="{{$item->id_kategori_order}}">{{$item->deskripsi}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div id="r_date_kategori_other" class="form-group" style="display:none">
                    <label for="exampleInputPassword1">Day Other <span style="color:red" >*</span><span style="color:red;display:none" id="warning_date_kategori_other" >Harus Number & max 90 hari </span></label>
                    <input type="number" class="form-control" id="date_kategori_other" placeholder="Days of Other" name="trip-start" value="{{$now_inputer}}"  min="{{$now_inputer}}" />
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Latitude <span style="color:red" >*</span><span style="color:red;display:none" id="warning_latitude" >Latitude Harus Terisi</span></label>
                    <input type="text" class="form-control" id="latitude"  placeholder="Latitude">
                  </div>
                  
                  <div class="form-group">
                    <label for="exampleInputPassword1">Longitude <span style="color:red" >*</span> <span style="color:red;display:none" id="warning_longitude" >Longitude Harus Terisi</span></label>
                    <input type="text" class="form-control" id="longitude" placeholder="Longitude">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat <span style="color:red" >*</span> <span style="color:red;display:none" id="warning_alamat" >Alamat Harus Terisi</span></label>
                    <textarea rows="5" style="width:500px" id="alamat" type="text" class="form-control" > </textarea>
                  </div>

                  <div id="l_odp" class="form-group">
                    <label for="exampleInputPassword1">Nama ODP <span style="color:red" >*</span> <span style="color:red;display:none" id="warning_odp" >Penulisan ODP tidak benar, contoh: ODP-PWT-FAB/001</span></label>
                    <input type="text" class="form-control" id="odp"  placeholder="Nama ODP">
                  </div>

                  <div class="card-footer">
                    <button id="popup" hidden  data-toggle="modal" data-target="#modal-default" type="button" class="close_ ">cek</button></td>
                    
                    <button style="display:none" hidden id="submit_inputer" data-toggle="modal" data-target="#modal-submit"  class="btn btn-primary">Submit</button>
                     <button type="button" style="display:none" id="validasi_sebelum_popup" class="btn btn-primary">Submit</button>
                  </div>

                  <input  type="hidden" id="type" value="1" />
                  <input  type="hidden" id="id"  >   

                </div>
                <button id="cek" style="display: none"  type="button" class="close_ btn btn-primary">cek</button></td>
              </div>
              <!-- /.card-body -->
          </div>
      </div>
  </div>
  <!-- /.col-md-6 -->


<div class="modal fade" id="modal-submit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><div style="float:left">Yakin submit order?<div></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div hidden class="modal-body">
        <div>
          <input id="id_cancel_pending" hidden  placeholder="isi di sini"/>
          <input id="status_order_cancel_pending" hidden  placeholder="isi di sini"/>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" hidden data-dismiss="modal" id="submit_inputer_new" class="btn btn-primary">Submit</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-default" >
  <div class="modal-dialog" style="width:1200px;max-height: 400px;">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title"><div style="float:left">Data Ditemukan pilih action anda</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body" style="overflow-y: auto;max-height: 400px;">
        <div  id="table_eksisting"></div>    
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" data-dismiss="modal" id="lanjut" class="btn btn-primary">lanjut input</button>
      <button type="button" data-dismiss="modal" id="clear" class="btn btn-primary">sudah ada data</button>
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

@endsection