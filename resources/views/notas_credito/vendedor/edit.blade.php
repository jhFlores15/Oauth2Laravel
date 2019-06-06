@extends('master')

@section('contenido')
<div class="container-fluid" id="app" >
	<notas_credito-update-component
		v-bind:id="{{ $id }}"
	 ></notas_credito-update-component>	
</div>

@endsection
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />

<script type="text/javascript">
  if(history.forward(1)){
    location.replace( history.forward(1) );
  }
</script>