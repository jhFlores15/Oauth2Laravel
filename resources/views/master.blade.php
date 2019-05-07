<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"; charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Fonts -->
    
     
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
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
       {{--  <nav class="navbar navbar-expand-lg navbar-dark bg-primary nav-fill w-100">
          <a class="navbar-brand" href="#">Encuesta Carozzi</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="toggle navigation" data-target="#navbarMaster" aria-controls="navbarMaster">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarMaster">
              <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item-active">
                  <a class="nav-link" href="{{ route('user.administradores') }}">{{ __('Administradores') }} <span class="sr-only">(current)</span>
                  </a>
                </li>
                <li class="nav-item-active">
                  <a class="nav-link" href="{{ route('user.vendedores') }}">{{ __('Vendedores') }} <span class="sr-only">(current)</span>
                  </a>
                </li> 
                
               
              
                          
              </ul> --}}
           {{--    <ul class="nav navbar-nav ml-auto">  
                <div id="app"> --}}
                  <login-component></login-component>    
{{--                 </div>
              </ul> --}}
            {{-- </div>          
        </nav> --}}
      </div>     
     <div> @yield('contenido')</div>      
  </div>
  <div id="encuesta_create"> @yield('vue.js')</div>       
    <script src="{{ mix('js/app.js') }}"></script>
    <div > @yield('dataTable')</div> 
     

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
  
    
    


        

<!--<footer>
    <div class="row navcolor" style="margin: 0; padding: 10px 0 10px 0; ">
      <div class="col-md-3" style="color: white;"> Copyrigt * {{ date('Y')}}</div>
      <div class="col-md-3" > <a style="color: white;" href="/policy/cookies">Politica de cookies</a></div>
      <div class="col-md-3" > <a style="color: white;" href="/policy/termsconditions">Terminos y Condiciones</a></div>
    </div>
</footer>  -->
</body>
</html>
