@extends('admin_template')


{{-- header --}}
@section('header')
    User
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


<div class="col-md-12">
  <div class="panel">
      <div class="panel-heading">
          <div class="panel-title">
          </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>                  
            <tr>
              <th style="width: 10px">No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Type</th>
              
              @if ($jenis_page == "1")
              <th style="width: 40px">Action</th>
              @endif
              
              @if ($jenis_page == "2")
              <th style="width: 40px">Alter</th>
              @endif
              
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $index =>$d)

              <tr>
                  <td>{{$index+1}}</td>
                  <td id="{{$d->id_user}}">{{$d->nama}}</td>
                  <td >{{$d->username}}</td>
                  <td >
                  {{$m_locker->getLockerFromId($d->id_role_user)}}
                  </td>
                  
                  @if($jenis_page =="1")
                    <td>
                      <table >
                          <tr>
                              @if ($d->id_status_user == "1" || $d->id_status_user == "3")  
                                <td><button id="approve_{{$d->id_user}}" type="button" class="approve btn btn-block btn-success btn-xs" alt="test">Approve</button></td>
                              @endif 

                              @if ($d->id_status_user == "4")  
                              <td><button id="restore_{{$d->id_user}}"   class="restore btn btn-block btn-primary btn-xs">Restore</button></td>
                                @endif 

                                @if ($d->id_status_user == "2" || $d->id_status_user == "1" || $d->id_status_user == "3")  
                                <td><button id="block_{{$d->id_user}}"  class="block btn btn-block btn-danger btn-xs">Block</button></td>
                                @endif 
                          </tr>
                        </table>
                  </td>
                  @endif

                  @if($jenis_page == "2")
                  <td width="200px">
                      <a href="#"><label id="alter_delete_{{$d->id_user}}" data-toggle="modal" data-target="#modal-default" class="alter_delete" >Delete</label></a> ||
                      <a href="#"><lebel id="alter_update_{{$d->id_user}}" data-toggle="modal" data-target="#modal-edit" class="alter_edit" >Edit</lebel></a>
                    </td>
                  @endif
                  
              </tr>
                  
              @endforeach
      
          </tbody>
        </table>
      </div>
  </div>
</div>
<!-- /.col-md-6 -->


<div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><div style="float:left">yakin&nbsp;</div><div style="float:left" id="response"> ?<div></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div hidden class="modal-body">
            <div>
              <input id="id_user" hidden  placeholder="isi di sini"/>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" id="btn_delete" class="btn btn-danger">Delete</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><div style="float:left">Edit Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div>
            <input id="id_user_edit" hidden  placeholder="isi di sini"/>
            User Telegram <br/>
            <input id="username" class="form-control" placeholder="isi di sini"/>
            <br/>
            Role User
            <select id="id_locker" class="form-control">
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" id="btn_edit" class="btn btn-success">Edit</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection