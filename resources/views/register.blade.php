@extends('cover_theme')

@section('content')
<div class="login-box">
  <div class="login-logo">
    {{--  <a href="../../index2.html"><b>Admin</b>LTE</a>  --}}
  </div>
  <!-- /.login-logo -->
   @if (session('status'))
          <div class="alert alert-warning">
              {{ session('status') }}
          </div>
      @endif
  <form action="{{url('/action_register')}}" method="post">
     {{ csrf_field() }}
      <div class="input-group mb-3">
        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
      </div> 
      
      <div class="input-group mb-3">
                <select id="id_role" name="id_role" class="form-control">
                    <option value="-">- Type user -</option>
                    @foreach ($data as $d)
                    
                    <option value="{{$d->id_locker}}">{{$d->deskripsi}}</option>    
                    
                    
                    @endforeach
                </select>

               </div>

               <div class="input-group mb-3" id="v_mitra" style="display:none">
                <select name="id_mitra" class="form-control">
                    <option value="-">- Pilih Mitra -</option>
                    
                    @foreach ($data_mitra as $d)
                      <option value="{{$d->id_mitra}}">{{$d->nama_mitra}}</option>    
                    @endforeach
                </select>

               </div>

              <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div> 
              <div class="input-group mb-3">
                <input name="password" type="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input name="repassword" type="password" class="form-control" placeholder="Retype password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
      <div class="form-button">
          <button id="submit" type="submit" class="ibtn">Login</button> 
          </div>
  </form>
</div>

{{--  <div class="register-box">
        <div class="register-logo">
          <a href="#"><b>Dlisa</b>Help</a>
        </div>
      
        <div class="card">
          <div class="card-body register-card-body">
            @if (session('status'))
              <div class="alert alert-warning">
                  {{ session('status') }}
              </div>
          @endif
            <p class="login-box-msg">Register.</p>
      
            <form action="{{url('/action_register')}}" method="post">
               {{ csrf_field() }}
              
              <div class="input-group mb-3">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div> 

              <div class="input-group mb-3">
                <select name="id_role" class="form-control">
                    <option>- Role -</option>
                    @foreach ($data as $d)
                    <!--@if ($d->id_role != "4")-->
                    <option value="{{$d->id_role}}">{{$d->deskripsi}}</option>    
                    <!--@endif-->
                    
                    @endforeach

                </select>

               </div>

              <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div> 
              <div class="input-group mb-3">
                <input name="password" type="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input name="repassword" type="password" class="form-control" placeholder="Retype password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
            <a href="{{url('/login')}}" class="text-center">Back Home</a>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>   --}}
@endsection