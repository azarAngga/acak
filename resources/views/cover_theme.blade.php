

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acak</title>
    <link rel="stylesheet" type="text/css" href="{{asset('login_layout/Template/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login_layout/Template/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login_layout/Template/css/iofrm-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login_layout/Template/css/iofrm-theme2.css')}}">
    <script src="{{asset('bower_components/light/assets/scripts/jquery.min.js')}}"></script>
</head>
<script>
    $(document).ready(function(){
        
        $('#id_role').on('change', function() {
            var role =  this.value
               if(role == "3"){
                $('#v_mitra').show() 
               }else{
                $('#v_mitra').hide()  
               }
         });
    })
 
</script>
<body>

    <div class="form-body">
        <div class="website-logo">
            <a href="#">
                {{--  <div class="logo">  --}}
                    <img  src="{{asset('new_acak.png')}}" >
                {{--  </div>  --}}
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">

                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Acak</h3>
                        <p>Selamat Datang di Aplikasi ACAK.</p>
                        <div class="page-links">
                            <a href="{{url('/login')}}" {{--class="active" --}}>Login</a><a href="{{url('/register')}}">Register</a>
                        </div>
                        @yield('content')
                        <div class="other-links">
                            {{--  <span>Or login with</span>  --}}
                            {{--  <a href="#">Facebook</a><a href="#">Google</a><a href="#">Linkedin</a>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{asset('login_layout/Template/js/jquery.min.js')}}"></script>
<script src="{{asset('login_layout/Template/js/popper.min.js')}}"></script>
<script src="{{asset('login_layout/Template/js/bootstrap.min.js')}}"></script>
<script src="{{asset('login_layout/Template/js/main.js')}}"></script>
</body>
</html>