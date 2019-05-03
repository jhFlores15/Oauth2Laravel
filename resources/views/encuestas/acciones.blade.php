
<a type="button" href="{{ route('encuestas.show',$id) }}" class="btn btn-primary btn-sm">Ver</a>

@if ($estado === 'Inactivo')
    <a type="button" href="#" class="btn btn-success btn-sm">Editar</a>
    <button type="button" href="#" class="btn btn-danger btn-sm">Eliminar</button>
@endif


