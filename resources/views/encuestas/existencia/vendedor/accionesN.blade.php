@if($encuesta->tipo_encuesta_id == 1)
	<a type="button" href="/encuestas/E/{{ $encuesta->id }}/{{ $id }}/create/" class="btn btn-primary btn-sm">Encuestar</a>
@else
@endif
