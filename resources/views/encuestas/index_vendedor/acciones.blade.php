@if($tipo_encuesta->id == 2)
	<a type="button" href="/encuestas/clientes/{{ $id }}" class="btn btn-primary btn-sm">A Encuestar</a>
@endif
@if(($tipo_encuesta->id == 1) || ($tipo_encuesta->id == 3) || ($tipo_encuesta->id == 4))
	<a type="button" href="/encuestas/E/P/{{ $id }}" class="btn btn-primary btn-sm">A Encuestar</a>
@endif


