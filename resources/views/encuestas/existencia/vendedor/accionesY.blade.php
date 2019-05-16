@if($encuesta->tipo_encuesta_id == 1)
	<a type="button" href="/encuestas/E/{{ $encuesta->id }}/{{ $id }}/edit/" class="btn btn-primary btn-sm">Editar Encuesta</a>
@else
@endif

