<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"; charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Fonts -->
    
   <!-- <link rel="dns-prefetch" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">-->
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">


	<title>{{ config('app.name', 'Encuesta Carozzi') }}</title>
    <style>
      body {
          height: 200%;
          background-color: white;
      }
      .imgRedondaNavbar {
          width:40px!important;
          height:40px!important;
          border-radius:20px!important;
          border:1px solid #C0C0C0;
          object-fit: cover;
      }
      .myDropDown
      {
         float:right;
        height: 125px;
        width:auto;
        overflow: auto;
      }
      .navcolor
      {
        background-color: #721422;
      }
  </style>
</head>
<body>
    @yield('Estilos')
    <div id="app">
      <div class="">
         <!--- <div class="col-md-3">
           
        </div> -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary nav-fill w-100">
          <a class="navbar-brand" href="#">Encuesta Carozzi</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="toggle navigation" data-target="#navbarMaster" aria-controls="navbarMaster">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarMaster">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item-active">
                  <a class="nav-link" href="{{ route('usuarios.administradores') }}">{{ __('Administradores') }} <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item-active">
                  <a class="nav-link" href="{{ route('usuarios.administradores') }}">{{ __('Vendedores') }} <span class="sr-only">(current)</span>
                  </a>
                </li>  
              
              </ul>
              <ul class="nav navbar-nav ml-auto">                
                <login-component></login-component> 
              </ul>
            </div>
          
        </nav>
      </div>     
     <div> @yield('contenido')</div>      
  </div>
    <script src="{{ mix('js/app.js') }}"></script>
        

<!--<footer>
    <div class="row navcolor" style="margin: 0; padding: 10px 0 10px 0; ">
      <div class="col-md-3" style="color: white;"> Copyrigt * {{ date('Y')}}</div>
      <div class="col-md-3" > <a style="color: white;" href="/policy/cookies">Politica de cookies</a></div>
      <div class="col-md-3" > <a style="color: white;" href="/policy/termsconditions">Terminos y Condiciones</a></div>
    </div>
</footer>  -->
</body>
</html>
