@extends('master')

@section('contenido')
<div class="container-fluid" id="app" >
	<notas_credito-update-component
		v-bind:id="{{ $id }}"
	 ></notas_credito-update-component>	
</div>

@endsection
