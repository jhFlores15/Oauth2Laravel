@extends('master')

@section('contenido')
<div class="container-fluid" id="app" >
	<encuesta-precio-vendedor-store-component
		v-bind:encuesta_id="{{ $encuesta_id }}"
  		v-bind:cliente_id="{{ $cliente_id }}"
	 ></encuesta-precio-vendedor-store-component>	
</div>

@endsection