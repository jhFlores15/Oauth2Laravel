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
      		<h5>¿Desea eliminar esta Comuna?</h5>
	      	</div>
	      	<div class="row text-center">
	      		<form>	   
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Comuna</label>
					    <div class="col-md-8">
					     	<input type="text" readonly class="form-control-plaintext" id="comunaDelete" value="">
					    </div>
				 	 </div>
				  	<div class="form-group row">
				    	<label for="staticEmail" class="col-md-4 col-form-label">Region</label>
				    	<div class="col-md-8">
				      		<input type="text" readonly class="form-control-plaintext" id="regionDelete" value="">
				   		 </div>
				 	</div>
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="okDelete" onclick="eliminarComuna()" class="btn btn-primary">Si</button>
      </div>
    </div>
  </div>
</div>


<!-- //////////////////////////////////Modal Editar//////////////////////////-->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Comuna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">      		
	      	<div class="row text-center">
				<form>	   
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Comuna</label>
					    <div class="col-md-8">
					     	<input type="text" class="form-control"  id="comunaEdit" placeholder="Comuna">
					     	 <div id="errorComuna"></div>
					    </div>

				 	 </div>
				  	<div class="form-group row">
				    	<label for="staticEmail" class="col-md-4 col-form-label">Region</label>		
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
        <button type="button" id="okEditar" onclick="editarComuna()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script >
	//var user; // se vuelve global

	//ejecutar modales
	function modalEliminar(id){
		document.getElementById('okDelete').value = id;
		ajax_getComuna(id,'eliminar');
		$('#deleteModal').modal('show');
	}

	function modalEditar(id){
		$('#errorComuna').html('<div></div>');
		document.getElementById('okEditar').value = id;
		ajax_getComuna(id,'editar');
		$('#editarModal').modal('show');
	}

	//////////relleno de modales/////////////

	function llenarModalEliminar(comuna){
		document.getElementById('comunaDelete').value = comuna.nombre;
		document.getElementById('regionDelete').value = comuna.region.nombre;
	}
	function llenarModalEditar(comuna){
		comboboxEdit(comuna.region_id);
		document.getElementById('comunaEdit').value = comuna.nombre;
	}
	function comboboxEdit(id){
 		$.ajax({
			method:"GET",
			url:'/api/regiones/',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				var regiones = resp.data;
				var opciones = '<select class="form-control" id="comboboxEdit">';
				for (var i = 0; i < regiones.length; i++) {
					if(regiones[i]['id'] == id){
						opciones += '<option selected="selected" value="'+regiones[i]['id']+'">'+regiones[i]['nombre']+'</option>';
					}
					else{
						opciones += '<option value="'+regiones[i]['id']+'">'+regiones[i]['nombre']+'</option>';
					}
				}
				$('#comboboxEdit').html(opciones+'</select>');		
			},
			error(error){				
				alert('Regiones no Encontradas');
				$('#deleteModal').modal('hide');				
			}
		});
 	}
	//llamar ajax
	function eliminarComuna(){
		var id = document.getElementById('okDelete').value;
		console.log("eliminando " + id);
		ajaxEliminar(id);
	}
	function editarComuna(){
		var id = document.getElementById('okEditar').value;
		var region_id  = $('#comboboxEdit option:selected').val();
		var nombre = document.getElementById('comunaEdit').value;
		console.log("editando " + id);
		ajaxEditar(id,nombre,region_id);		
	}
	

	//////////////funciones ajax//////////////
	function ajaxEditar(id,nombre,region_id){
		$('#okEditar').html('<div class="loader"></div>');
		var data = {
			'nombre' : nombre,
            'region_id' : region_id,
		};
		$.ajax({
			method:"PUT",
			url:'/api/comunas/'+ id,
			data: JSON.stringify(data),
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Edicion Exitosa', 'success', 3, function(){  console.log(); });  
					location.reload(true);

				}
			},
			error(error){
				if(error.status == 422){
					var errores = error.responseJSON.error;
					incrustarErrores(errores);	
				}
				else{
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Error', 'error', 3, function(){  console.log(); });  
				}
			}
		});
		$('#okEditar').html('<button type="button" id="okEditar" onclick="editarComuna()" class="btn btn-primary">Guardar</button>');
	}


	function ajax_getComuna(id,modal){
		$.ajax({
			method:"GET",
			url:'/api/comunas/'+id,
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
				alert('Comuna no Encontrada');
				$('#deleteModal').modal('hide');
				
				
			}
		});
	}

	function ajaxEliminar(id){
		$('#okDelete').html('<div class="loader"></div>');
		$.ajax({
			method:"DELETE",
			url:'/api/comunas/'+ id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Comuna Eliminada', 'success', 3, function(){  console.log(); });  
					location.reload();
				}
			},
			error(error){
				alertify.set('notifier','position', 'top-right');
				alertify.notify('Esta Comuna no puede ser Eliminada, constituye perdida de Datos', 'error', 6, function(){  console.log(); });  
				$('#deleteModal').modal('hide');
			}
		});
		$('#okDelete').html('<button type="button" id="okDelete" onclick="eliminarComuna()" class="btn btn-primary">Si</button>');
	}
	function incrustarErrores(errores){
		$('#errorComuna').html('<div></div>');
		
		if(errores.nombre){
			$('#errorComuna').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.nombre[0]+
				'</div>'
				);
		}		
	}


	
</script>
