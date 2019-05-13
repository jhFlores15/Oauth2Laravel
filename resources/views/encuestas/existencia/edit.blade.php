@extends('master')

@section('contenido')
<div class="container-fluid" id="app" >
	<encuesta-existencia-edit-component
		v-bind:encuesta_id="{{ $encuesta_id }}"
	 ></encuesta-existencia-edit-component>	
</div>

@endsection