@if($tipo_encuesta->id == 2)
	<a type="button" href="/encuesta/clientes/{{ $id }}" class="btn btn-primary btn-sm">Ver</a>
@endif

@if ($estado === 'Inactivo' && $tipo_encuesta->id == 2)
    <button type="button" onclick="modalEliminar({{ $id}})" class="btn btn-danger btn-sm ">
		Eliminar
	</button>
@endif

@if ($estado === 'Inactivo' && $tipo_encuesta->id != 2)
    <button type="button" onclick="modalEliminar({{ $id}})" class="btn btn-danger btn-sm ">
		Eliminar
	</button>
@endif

<!-- ////////////////////Modal Eliminar////////////////////////////-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Encuesta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">
      		<div class="row text-center">
      		<h5>¿Desea eliminar esta Esta Encuesta?</h5>
	      	</div>
	      	<div class="row text-center">
	      		<form>	   
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Descripcion</label>
					    <div class="col-md-8">
					     	<input type="text" readonly class="form-control-plaintext" id="descripcionDelete" value="">
					    </div>
				 	 </div>
				  	<div class="form-group row">
				    	<label for="staticEmail" class="col-md-4 col-form-label">Fecha Inicio</label>
				    	<div class="col-md-8">
				      		<input type="date" readonly class="form-control-plaintext" id="fechaDelete" value="">
				   		 </div>
				 	</div>
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="okDelete" onclick="eliminarEncuesta()" class="btn btn-primary">Si</button>
      </div>
    </div>
  </div>
</div>
<script>
	
	function modalEliminar(id){
		document.getElementById('okDelete').value = id;
		ajax_getEncuesta(id,'eliminar');
		$('#deleteModal').modal('show');
	}
	function ajax_getEncuesta(id){ // obtener este tipo d eencuesta
		$.ajax({
			method:"GET",
			url:'/api/encuestas/clientes/'+id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				document.getElementById('descripcionDelete').value = resp.descripcion;
				document.getElementById('fechaDelete').value = resp.inicio;
			},
			error(error){				
				alert('Encuesta no Encontrada');
				$('#deleteModal').modal('hide');				
			}
		});
	}
	function eliminarEncuesta(){ // este tipo de encuesta
		var id = document.getElementById('okDelete').value;
		ajaxEliminar(id);
	}
	function ajaxEliminar(id){// este tipo de encuesta
		$.ajax({
			method:"DELETE",
			url:'/api/encuestas/clientes/'+id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Encuesta Eliminada Exitosamente');
					location.reload();
				}
			},
			error(error){
				alert('Encuesta no puede ser Eliminada, constituye perdida de Datos');
				$('#deleteModal').modal('hide');
			}
		});
	}
</script>


