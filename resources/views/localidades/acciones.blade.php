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
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Comuna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">
      		<div class="row text-center">
      		<h5>¿Desea eliminar esta Localidad?</h5>
	      	</div>
	      	<div class="row text-center">
	      		<form>
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Codigo</label>
					    <div class="col-md-8">
					     	<input type="text" readonly class="form-control-plaintext" id="codigoDelete" value="">
					    </div>
				 	 </div>	   
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Localidad</label>
					    <div class="col-md-8">
					     	<input type="text" readonly class="form-control-plaintext" id="localidadDelete" value="">
					    </div>
				 	 </div>
				  	<div class="form-group row">
				    	<label for="staticEmail" class="col-md-4 col-form-label">Comuna</label>
				    	<div class="col-md-8">
				      		<input type="text" readonly class="form-control-plaintext" id="comunaDelete" value="">
				   		 </div>
				 	</div>
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="okDelete" onclick="eliminarLocalidad()" class="btn btn-primary">Si</button>
      </div>
    </div>
  </div>
</div>


<!-- //////////////////////////////////Modal Editar//////////////////////////-->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Localidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">      		
	      	<div class="row text-center">	
				<form>	  
					<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Codigo</label>
					    <div class="col-md-8">
					     	<input type="number" class="form-control"  id="codigoEdit" placeholder="Codigo">
					     	 <div id="errorCodigo"></div>
					    </div>

				 	 </div> 
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Localidad</label>
					    <div class="col-md-8">
					     	<input type="text" class="form-control"  id="localidadEdit" placeholder="Localidad">
					     	 <div id="errorLocalidad"></div>
					    </div>

				 	 </div>
				  	<div class="form-group row">
				    	<label for="staticEmail" class="col-md-4 col-form-label">Comuna</label>		
				    	<div class="col-md-8">
				    		<div id="comboboxEdit">
			  				</div>	
				      		{{-- <input type="text" readonly class="form-control-plaintext" id="regionDelete" value=""> --}}
				   		 </div>
				 	</div>
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="okEditar" onclick="editarLocalidad()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script >
	//var user; // se vuelve global

	//ejecutar modales
	function modalEliminar(id){
		document.getElementById('okDelete').value = id;
		ajax_getLocalidad(id,'eliminar');
		$('#deleteModal').modal('show');
	}

	function modalEditar(id){
		$('#errorComuna').html('<div></div>');
		document.getElementById('okEditar').value = id;
		ajax_getLocalidad(id,'editar');
		$('#editarModal').modal('show');
	}

	//////////relleno de modales/////////////

	function llenarModalEliminar(localidad){
		document.getElementById('codigoDelete').value = localidad.codigo;
		document.getElementById('localidadDelete').value = localidad.nombre;
		document.getElementById('comunaDelete').value = localidad.comuna.nombre;
	}
	function llenarModalEditar(localidad){
		comboboxEdit(localidad.comuna_id);
		document.getElementById('localidadEdit').value = localidad.nombre;
		document.getElementById('codigoEdit').value = localidad.codigo;
	}
	function comboboxEdit(id){
 		$.ajax({
			method:"GET",
			url:'/api/comunas/',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				var comunas = resp.data;
				var opciones = '<select class="form-control" id="comboboxEdit">';
				for (var i = 0; i < comunas.length; i++) {
					if(comunas[i]['id'] == id){
						opciones += '<option selected="selected" value="'+comunas[i]['id']+'">'+comunas[i]['nombre']+'</option>';
					}
					else{
						opciones += '<option value="'+comunas[i]['id']+'">'+comunas[i]['nombre']+'</option>';
					}
				}
				$('#comboboxEdit').html(opciones+'</select>');		
			},
			error(error){				
				alert('Comunas no Encontradas');
				$('#deleteModal').modal('hide');				
			}
		});
 	}
	//llamar ajax
	function eliminarLocalidad(){
		var id = document.getElementById('okDelete').value;
		console.log("eliminando " + id);
		ajaxEliminar(id);
	}
	function editarLocalidad(){
		var id = document.getElementById('okEditar').value;
		var comuna_id  = $('#comboboxEdit option:selected').val();
		var nombre = document.getElementById('localidadEdit').value;
		var codigo = document.getElementById('codigoEdit').value;
		console.log("editando " + id);
		ajaxEditar(id,nombre,comuna_id,codigo);		
	}
	

	//////////////funciones ajax//////////////
	function ajaxEditar(id,nombre,comuna_id,codigo){
		var data = {
			'nombre' : nombre,
            'comuna_id' : comuna_id,
            'codigo' : codigo,
		};
		$.ajax({
			method:"PUT",
			url:'/api/localidades/'+ id,
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
				if(error.status == 422){
					var errores = error.responseJSON.error;
					incrustarErrores(errores);
				}
				else{
					alert("error");
				}
				//alert('Usuario no puede ser Eliminado, constituye perdida de Datos');
			}
		});
	}


	function ajax_getLocalidad(id,modal){
		$.ajax({
			method:"GET",
			url:'/api/localidades/'+id,
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
				alert('Localidad no Encontrada');
				$('#deleteModal').modal('hide');
			}
		});
	}

	function ajaxEliminar(id){
		$.ajax({
			method:"DELETE",
			url:'/api/localidades/'+ id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Localidad Eliminada Exitosamente');
					location.reload();
				}
			},
			error(error){
				alert('Localidad no puede ser Eliminada, constituye perdida de Datos');
				$('#deleteModal').modal('hide');
			}
		});
	}
	function incrustarErrores(errores){
		$('#errorCodigo').html('<div></div>');
		$('#errorLocalidad').html('<div></div>');
		
		if(errores.codigo){
			$('#errorCodigo').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.codigo[0]+
				'</div>'
				);
		}	
		if(errores.nombre){
			$('#errorLocalidad').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.nombre[0]+
				'</div>'
				);
		}		
	}


	
</script>
