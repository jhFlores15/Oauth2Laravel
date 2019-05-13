@extends('master')

@section('contenido')
<div class="container-fluid" id="app" >
	<encuesta-vendedor-cliente-edit-component
		v-bind:encuesta_id="{{ $encuesta_id }}"
	 ></encuesta-vendedor-cliente-edit-component>	
</div>

@endsection