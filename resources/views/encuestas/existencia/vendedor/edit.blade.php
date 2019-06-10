@extends('master')

@section('contenido')
<div class="container-fluid" id="app" >
	<encuesta-existencia-vendedor-edit-component
		v-bind:encuesta_id="{{ $encuesta_id }}"
  		v-bind:cliente_id="{{ $cliente_id }}"
	 ></encuesta-existencia-vendedor-edit-component>	
</div>

@endsection