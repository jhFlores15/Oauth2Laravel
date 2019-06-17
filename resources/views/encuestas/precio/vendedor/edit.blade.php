@extends('master')

@section('contenido')
<div class="container-fluid" id="app" >
	<encuesta-precio-vendedor-edit-component
		v-bind:encuesta_id="{{ $encuesta_id }}"
  		v-bind:cliente_id="{{ $cliente_id }}"
	 ></encuesta-precio-vendedor-edit-component>	
</div>

@endsection