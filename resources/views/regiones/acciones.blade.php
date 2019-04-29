<!-- Button trigger modal -->
<button type="button" onclick="modalEditar({{ $id}})" class="btn btn-primary ">
   Editar
</button>
<button type="button" onclick="modalEliminar({{ $id}})" class="btn btn-danger ">
	Eliminar
</button>

<!-- ////////////////////Modal Eliminar////////////////////////////-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Region</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">
      		<div class="row text-center">
      		<h5>¿Desea eliminar esta Region?</h5>
	      	</div>
	      	<div class="row text-center">
	      		<form>	   
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Numero</label>
					    <div class="col-md-8">
					     	<input type="text" readonly class="form-control-plaintext" id="numDelete" value="">
					    </div>
				 	 </div>
				  	<div class="form-group row">
				    	<label for="staticEmail" class="col-md-4 col-form-label">Nombre</label>
				    	<div class="col-md-8">
				      		<input type="text" readonly class="form-control-plaintext" id="nameDelete" value="">
				   		 </div>
				 	</div>
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="okDelete" onclick="eliminarRegion()" class="btn btn-primary">Si</button>
      </div>
    </div>
  </div>
</div>


<!-- //////////////////////////////////Modal Editar//////////////////////////-->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Region</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">      		
	      	<div class="row text-center">
	      		<form>
	      			<div class="form-row">
				    	<div class="form-group col-md-12">
				      		<label >Numero</label>
				      		<input type="number" class="form-control" id="numEdit" placeholder="Numero">
				       	<div id="errorNum">
				      	</div>
				    	</div>				   
				  	</div>
				  <div class="form-row">
				    <div class="form-group col-md-12">
				      <label for="inputEmail4">Nombre</label>
				      <input type="text" class="form-control" id="nameEdit" placeholder="Nombre">
				       <div id="errorName">
				      </div>
				    </div>				   
				  </div>
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="okEditar" onclick="editarRegion()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script >
	//var user; // se vuelve global

	//ejecutar modales
	function modalEliminar(id){
		document.getElementById('okDelete').value = id;
		ajax_getRegion(id,'eliminar');
		$('#deleteModal').modal('show');
	}

	function modalEditar(id){
		$('#errorName').html('<div></div>');
		$('#errorNum').html('<div></div>');
		document.getElementById('okEditar').value = id;
		ajax_getRegion(id,'editar');
		$('#editarModal').modal('show');
	}

	//////////relleno de modales/////////////

	function llenarModalEliminar(region){
		document.getElementById('numDelete').value = region.numero;
		document.getElementById('nameDelete').value = region.nombre;
	}
	function llenarModalEditar(region){
		document.getElementById('nameEdit').value = region.nombre;
		document.getElementById('numEdit').value = region.numero;
	}

	//llamar ajax
	function eliminarRegion(){
		var id = document.getElementById('okDelete').value;
		console.log("eliminando " + id);
		ajaxEliminar(id);
	}
	function editarRegion(){
		var id = document.getElementById('okEditar').value;
		var nombre = document.getElementById('nameEdit').value;
		var numero = document.getElementById('numEdit').value;	
		console.log("editando " + id);
		ajaxEditar(id,nombre,numero);		
	}
	

	//////////////funciones ajax//////////////
	function ajaxEditar(id,nombre,numero){
		var data = {
			'nombre' : nombre,
            'numero' : numero,
		};
		$.ajax({
			method:"PUT",
			url:'/api/regiones/'+ id,
			data: JSON.stringify(data),
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Edicion Exitosa');
					location.reload(true);

				}
			},
			error(error){
				var errores = error.responseJSON.error;
				incrustarErrores(errores);	
				//alert('Usuario no puede ser Eliminado, constituye perdida de Datos');
			}
		});
	}


	function ajax_getRegion(id,modal){
		$.ajax({
			method:"GET",
			url:'/api/regiones/'+id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				if(modal == 'eliminar'){
					llenarModalEliminar(resp);
				}
				else{
					llenarModalEditar(resp);
				}
			},
			error(error){				
				alert('Region no Encontrada');
				$('#deleteModal').modal('hide');
				
				
			}
		});
	}

	function ajaxEliminar(id){
		$.ajax({
			method:"DELETE",
			url:'/api/regiones/'+ id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Region Eliminada Exitosamente');
					location.reload();
				}
			},
			error(error){
				alert('Region no puede ser Eliminada, constituye perdida de Datos');
				$('#deleteModal').modal('hide');
			}
		});
	}
	function incrustarErrores(errores){
		$('#errorName').html('<div></div>');
		$('#errorNum').html('<div></div>');
		
		if(errores.nombre){
			$('#errorName').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.nombre[0]+
				'</div>'
				);
		}
		if(errores.numero){
			$('#errorNum').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.numero[0]+
				'</div>'
				);
		}		
	}
	
</script>
