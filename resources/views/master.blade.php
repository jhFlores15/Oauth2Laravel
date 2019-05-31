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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">

    <!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">



	<title>Encuestas Carozzi</title>
    <style>
      body {
          height: 200%;
          background-color: white;
      }
      .imgRedondaNavbar {
          width:150px!important;
          height:40px!important;
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
        background-color: #721422 !important;
      }
      .custom-file-input:lang(en) ~ .custom-file-label::after {
      content: 'Examinar' !important;
    }
    .loader {
      border: 10px solid #f3f3f3;
      border-radius: 100%;
      border-top: 10px solid #3498db;
      border-bottom: 10px solid #3498db;
      width: 40px;
      height: 40px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
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
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
         <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
         <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js "></script>
         <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>   

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>





  
    
    


        

<!--<footer>
    <div class="row navcolor" style="margin: 0; padding: 10px 0 10px 0; ">
      <div class="col-md-3" style="color: white;"> Copyrigt * {{ date('Y')}}</div>
      <div class="col-md-3" > <a style="color: white;" href="/policy/cookies">Politica de cookies</a></div>
      <div class="col-md-3" > <a style="color: white;" href="/policy/termsconditions">Terminos y Condiciones</a></div>
    </div>
</footer>  -->
</body>
</html>
