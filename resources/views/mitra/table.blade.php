@extends('admin_template')


{{-- header --}}
@section('header')
    Mitra
@endsection
{{-- end header --}}


{{-- menu title --}}
@section('menu_title')
    <li class="breadcrumb-item"><a href="#">Table</a></li>
    <li class="breadcrumb-item"><a href="#">Mitra</a></li>
@endsection
{{-- end menu title --}}

{{-- content --}}
@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div style="width:1000px">
				<div class="box-content">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
              <div class="card-header">
              <h3 class="card-title">Table Mitra</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <button type="button" id="Create" class="btn btn-success" data-toggle="modal" data-target="#modal-create" >+ Create Mitra</button>
            <div>&nbsp;</div>
              <table class="table table-bordered">
                <thead>                  
                  <tr>
                    <th style="width: 10px">NO</th>
                    <th>NAMA</th>
                    <th>DATEL</th>
                    <th>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index =>$d)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td id="{{$d->id_mitra}}">{{$d->nama_mitra}}</td>
                        <td ><div id="nama_{{$d->id_mitra}}">{{$d->alamat}}</td>
                        <td>

                        <a href="#"><label id="delete_mitra_{{$d->id_mitra}}" data-toggle="modal" data-target="#modal-default" class="delete_mitra" name="person-remove-outline">Delete</label></a>||
                        <a href="#"><label id="update_mitra_{{$d->id_mitra}}" data-toggle="modal" data-target="#modal-create" class="edit_mitra" name="create-outline">Update</label></a></td>
                    </tr>
                        
                    @endforeach       
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            
          </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
  
        </div>
      </div>
    </div>
  </div>
</div> 

<div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><div style="float:left">yakin Delete Mitra &nbsp;</div><div style="float:left" id="delete_val_mitra"> ?<div></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div hidden class="modal-body">
            <div>
              <input id="id_mitra_delete"  class="form-control" placeholder="isi di sini"/>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" id="btn_delete_mitra" class="btn btn-danger">Delete</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><div style="float:left">Create Mitra<div></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div  class="modal-body">
        <div>
          <label>Nama Mitra</label>
          <input id="id_mitra_update" hidden  placeholder="isi di sini"/>
          <input id="nama_mitra"  class="form-control" placeholder="isi di sini"/>
          <label>Alamat Mitra</label>
          <input id="alamat"  class="form-control" placeholder="isi di sini"/>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" id="btn_save_mitra" class="btn btn-success">save</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection