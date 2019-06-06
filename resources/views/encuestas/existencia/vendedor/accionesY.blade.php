@if($encuesta->tipo_encuesta_id == 1)
	<a type="button" href="/encuestas/E/{{ $encuesta->id }}/{{ $id }}/edit/" class="btn btn-primary btn-sm">Editar Encuesta</a>
@elseif(($encuesta->tipo_encuesta_id == 3) || ($encuesta->tipo_encuesta_id == 4))
	<a type="button" href="/encuestas/P/{{ $encuesta->id }}/{{ $id }}/edit/" class="btn btn-primary btn-sm">Editar Encuesta</a>
@endif


