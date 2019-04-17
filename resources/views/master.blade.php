<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="d032af19-31bb-4e8d-9f45-5d5fc84be982" type="text/javascript" async></script>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"; charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
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
      <div class="row">
        <div class="col-md-3">
            <login-component> </login-component>
        </div>
      </div>  
      <label>memem {{ auth('api')->user() }}</label>
    {{--   <b-navbar class="navcolor sticky-top" toggleable="md" type="dark">
         <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
      <b-navbar-brand href="/"><img src="/storage/logo/logo2.png"></b-navbar-brand>
        <nav_filter></nav_filter>       
        <b-collapse is-nav id="nav_collapse">   
           <b-navbar-nav>
            <b-nav-item href="#">{{ __('hhhhhhh') }}</b-nav-item>
          <categories_filter></categories_filter>
        </b-navbar-nav>     
           <b-navbar-nav left class="ml-auto">              
                    <b-nav-item-dropdown text="Administracion" right>
                       <div role="group">
                          <b-dropdown-header>Usuarios</b-dropdown-header>
                          <b-dropdown-header>Usuarios</b-dropdown-header>
                          <b-dropdown-header>Usuarios</b-dropdown-header>                       
                        </div>

                        <div role="group" >
                                <b-dropdown-header>Denuncias</b-dropdown-header>
                                <b-dropdown-item  href="#">{{ __('Denuncia a Usuarios') }}</b-dropdown-item>
                               <b-dropdown-item  href="#">{{ __('Denuncia a Usuarios') }}</b-dropdown-item>
                        </div>

                        <div role="group" a>
                          <b-dropdown-header >Registros</b-dropdown-header>
                           <b-dropdown-item  href="#">{{ __('Denuncia a Usuarios') }}</b-dropdown-item>
                          <b-dropdown-item  href="#">{{ __('Denuncia a Usuarios') }}</b-dropdown-item>
                          <b-dropdown-item  href="#">{{ __('Denuncia a Usuarios') }}</b-dropdown-item>                           
                        </div>                       
                      </b-nav-item-dropdown>  
                     
              </b-navbar-nav>
               <b-navbar-nav class="ml-auto">
              @guest              
                <b-nav-item href="#">{{ __('Iniciar Sesion') }}</b-nav-item> 
                <b-nav-item href="# ">{{ __('Registrarse') }}</b-nav-item> 
              @else                
                  <b-dropdown variant="info" split right>                 
                  <b-nav-item-dropdown split right text="">
                    <b-dropdown-item href="#" >{{ __('Cambiar Contraseña') }}</b-dropdown-item>
                    <b-dropdown-divider></b-dropdown-divider>
                   <b-dropdown-item  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Cerrar Sesion') }}</b-dropdown-item>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf</form>                   </b-nav-item-dropdown>
               @endguest 
          </b-navbar-nav>

        </b-collapse>
      </b-navbar>  --}}    
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
