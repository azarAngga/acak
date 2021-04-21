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
<!-- <div class="row">

    <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Inputer</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Myir / SC / IN</label>
                <input type="text" class="form-control" id="wo"  placeholder="myir / sc / in">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Nama Calang</label>
                <input type="text" class="form-control" id="calang"  placeholder="Nama Calang">
              </div>
              <div id="after_calang" style="display:none">
                <div class="form-group">
                  <label for="exampleInputPassword1">Latitude</label>
                  <input type="text" class="form-control" id="latitude"  placeholder="Latitude">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Longitude</label>
                  <input type="text" class="form-control" id="longitude" placeholder="Longitude">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Alamat</label>
                  <textarea rows="5" style="width:500px" id="alamat" type="text" class="form-control" > </textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama ODP</label>
                  <input type="text" class="form-control" id="odp"  placeholder="Nama ODP">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Kategori</label>
                  <select class="form-control"  id="kategori">
                    <option>- Pilih Kategori -</option>
                    @foreach ($m_kategory_order as $item)

                    <option value="{{$item->id_kategori_order}}">{{$item->deskripsi}}</option>
                    @endforeach
                  
                  </select>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
    
            <div class="card-footer">
              <button style="display:none" id="submit_inputer" class="btn btn-primary">Submit</button>
            </div>
        </div>
        <!-- /.card -->
    
      </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>

      <button hidden id="popup"  data-toggle="modal" data-target="#modal-default" type="button" class="close_ btn btn-block btn-primary btn-xs">open</button></td>
                     

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><div style="float:left">Data Ditemukan pilih action anda</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" data-dismiss="modal" id="lanjut" class="btn btn-primary">Lanjut?</button>
              <button type="button" data-dismiss="modal" id="clear" class="btn btn-primary">clear data</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.modal -->

    <input hidden type="text" id="type" value="1" />
    <input hidden type="text" class="form-control" id="id"  >   


    <!-- /.modal -->
   


       -->
@endsection