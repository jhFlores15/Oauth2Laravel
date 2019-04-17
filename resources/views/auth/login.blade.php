@extends('master')

@section('contenido')
<body id="Login">
    <div class="container">
             <div class="login-form row">
                <div class="col-md-6 columna2">
                    <img src="/storage/logo/LogoG.png">
                </div>
                <div class="col-md-6">
                    <div class="main-div">
                        <div class="panel">
                            <img src="/storage/logo/LogoBig.png">
                        </div>
                        <div class="borde"></div>
                        <form id="Login" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Contraseña">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group" style="text-align: left !important;">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Recuerdame') }}
                            </div>
                            <div class="forgot">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
    </div></div>
</body>
<script  type="text/javascript">
  $(document).ready(function() {

   axios.post('/api/auth/login',{
        password : '220608mixi',
        email :'johflores1510@gmail.com',                
    }).then(response =>{
      console.log(response.data);
      localStorage.setItem('access_token',response.data.access_token); 
      localStorage.setItem('token_type',response.data.token_type);      
    }).catch(error =>{
        // if(error.response.status==500){
        //     console.log(error.response);
        // }          
    });
     
  });
</script>
<style type="text/css">
    .borde{
        border-top-style: solid;
        border-top-color: #721422;
        padding-bottom: 20px; 
    }
    .columna2{
        max-width: 50%;
        max-height: 50%;
        padding-top: 50px;
    }
    body#Login{ background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover;}
    .container{
        padding-top: 10px;

    }
    .form-heading { color:#fff; font-size:23px;}
    .panel {
        margin-bottom: 15px;
    }
    .login-form .form-control {
      border: 1px solid #d4d4d4;
      border-radius: 4px;
      font-size: 14px;
      height: 50px;
    }
    .main-div {
      background: #ffffff none repeat scroll 0 0;
      border-radius: 8px;
      margin: 10px auto 30px;
      max-width: 80%;
      padding: 50px 70px 50px 71px;
    }

    .login-form .form-group {
      margin-bottom:10px;
    }
    .login-form{ 
      text-align:center;
      padding-top: 5px;
    }
    .forgot a {
      color: #777777;
      font-size: 14px;
      text-decoration: underline;
    }
    .login-form  .btn.btn-primary {
      background: #9b111e none repeat scroll 0 0;
      border-color: #f0ad4e;
      color: #ffffff;
      font-size: 14px;
      width: 100%;
      height: 50px;
      line-height: 50px;
      padding: 0;
    }
    .forgot {
      text-align: left; margin-bottom:30px;
    }
    .botto-text {
      color: #ffffff;
      font-size: 14px;
      margin: auto;
    }
    .login-form .btn.btn-primary.reset {
      background: #ff9900 none repeat scroll 0 0;
    }
    .back { text-align: left; margin-top:10px;}
    .back a {color: #444444; font-size: 13px;text-decoration: none;}
</style>
@endsection
