
@if($tipo_encuesta->id == 2)
	<a type="button" href="/encuestas/clientes/{{ $id }}" class="btn btn-primary btn-sm">A Encuestar</a>
@endif
@if($tipo_encuesta->id == 1)
	<a type="button" href="/encuestas/existencia/{{ $id }}" class="btn btn-primary btn-sm">A Encuestar</a>
@endif
@if($tipo_encuesta->id == 3)
	<a type="button" href="/encuestas/clientes/{{ $id }}" class="btn btn-primary btn-sm">A Encuestar</a>
@endif


