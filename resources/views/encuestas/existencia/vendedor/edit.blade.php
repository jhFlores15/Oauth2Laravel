@extends('master')

@section('contenido')
<div class="container-fluid" id="app" >
	<encuesta-existencia-vendedor-edit-component
		v-bind:encuesta_id="{{ $encuesta_id }}"
  		v-bind:cliente_id="{{ $cliente_id }}"
	 ></encuesta-existencia-vendedor-edit-component>	
</div>

@endsection
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />

<script type="text/javascript">
  if(history.forward(1)){
    location.replace( history.forward(1) );
  }
</script>