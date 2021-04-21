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
  <form action="{{url('/login')}}" method="post">
     {{ csrf_field() }}
      <input class="form-control" type="text" name="username" placeholder="username" required>
      <input class="form-control" type="password" name="password" placeholder="Password" required>
      <div class="form-button">
          <button id="submit" type="submit" class="ibtn">Login</button> 
          </div>
  </form>
</div>

{{--  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      @if (session('status'))
          <div class="alert alert-warning">
              {{ session('status') }}
          </div>
      @endif

      <form action="{{url('login')}}" method="post">
           {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          
         
          <!-- /.col -->
        </div>
        <p class="mb-2">
            <a href="{{url('/register')}}">Register</a>
          </p>
      </form>

      <div class="social-auth-links text-center mb-3">
        
      </div>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.login-card-body -->
  </div>  --}}
<!-- /.login-box -->
@endsection