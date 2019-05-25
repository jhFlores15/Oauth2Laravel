@if($tipo_encuesta->id == 2)
	<a type="button" href="/encuesta/clientes/{{ $id }}" class="btn btn-primary btn-sm">Ver</a>
@endif
@if($tipo_encuesta->id == 1)
	<a type="button" href="/encuestas/E/{{ $id }}" class="btn btn-primary btn-sm">Ver</a>
@endif
@if($tipo_encuesta->id == 3)
	<a type="button" href="/encuestas/P/{{ $id }}" class="btn btn-primary btn-sm">Ver</a>
@endif


@if ($estado === 'Inactivo' && $tipo_encuesta->id == 2)
    <button type="button" onclick="modalEliminar({{ $id}})" class="btn btn-danger btn-sm ">
		Eliminar
	</button>
@endif

<?php $boolEditable =  \App\Encuesta::Editable_Eliminable($id); ?>
@if ($boolEditable === true && $tipo_encuesta->id != 2)	
    <button type="button" onclick="modalEliminar({{ $id}})" class="btn btn-danger btn-sm ">
		Eliminar
	</button>
	 <a type="button" href="/encuestas/{{ $id }}/edit/" class="btn btn-primary btn-sm">Editar</a>
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

		@if($tipo_encuesta->id == 2)
       		<button type="button" id="okDelete" onclick="eliminarEncuesta()" class="btn btn-primary delete2">Si</button>
       	@endif
       	@if(($tipo_encuesta->id == 1) ||($tipo_encuesta->id == 3)) <!-- Existencia Precio-->
       		<button type="button" id="okDelete" onclick="eliminarEncuestaEP()" class="btn btn-primary delete13">Si</button>
       	@endif		
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
	function eliminarEncuestaEP(){ // este tipo de encuesta
		var id = document.getElementById('okDelete').value;
		ajaxEliminarEP(id);
	}
	function ajaxEliminarEP(id){// este tipo de encuesta
		$('.delete13').html('<div class="loader"></div>');
		$.ajax({
			method:"DELETE",
			url:'/api/encuestas/'+id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Encuesta Eliminada Exitosamente', 'success', 3, function(){  console.log(); }); 
					location.reload();
				}
			},
			error(error){
				alertify.set('notifier','position', 'top-right');
				alertify.notify('Encuesta no puede ser Eliminada, constituye perdida de Datos', 'error', 6, function(){  console.log(); }); 
				$('#deleteModal').modal('hide');
			}
		});
		$('.delete13').html('<button type="button" id="okDelete" onclick="eliminarEncuestaEP()" class="btn btn-primary delete13">Si</button>');
	}
	function ajaxEliminar(id){// este tipo de encuesta
		$('.delete2').html('<div class="loader"></div>');
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
					alertify.set('notifier','position', 'top-right');
					lertify.notify('Encuesta Eliminada', 'success', 3, function(){  console.log(); }); 
					location.reload();
				}
			},
			error(error){
				alertify.set('notifier','position', 'top-right');
				alertify.notify('Encuesta no puede ser Eliminada, constituye perdida de Datos', 'error', 6, function(){  console.log(); }); 
				$('#deleteModal').modal('hide');
			}
		});
		$('.delete2').html('<button type="button" id="okDelete" onclick="eliminarEncuesta()" class="btn btn-primary delete2">Si</button>');
	}
</script>


