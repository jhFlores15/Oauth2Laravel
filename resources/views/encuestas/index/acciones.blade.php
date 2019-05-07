@if($tipo_encuesta->id == 2)
	<a type="button" href="/encuesta/clientes/{{ $id }}" class="btn btn-primary btn-sm">Ver</a>
@endif

@if ($estado === 'Inactivo')
    <a type="button" href="#" class="btn btn-success btn-sm">Editar</a>
    <button type="button" href="#" class="btn btn-danger btn-sm">Eliminar</button>
@endif


