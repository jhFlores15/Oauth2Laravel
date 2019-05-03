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
      		<h5>¿Desea eliminar este Cliente?</h5>
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
				    	<label for="staticEmail" class="col-md-4 col-form-label">Razon Social</label>
				    	<div class="col-md-8">
				      		<input type="text" readonly class="form-control-plaintext" id="razonDelete" value="">
				   		 </div>
				 	</div>
				 	<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Rut</label>
					    <div class="col-md-8">
					     	<input type="text" readonly class="form-control-plaintext" id="rutDelete" value="">
					    </div>
				 	 </div>
				 	 <div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Vendedor</label>
					    <div class="col-md-8">
					     	<input type="text" readonly class="form-control-plaintext" id="userDelete" value="">
					    </div>
				 	 </div>
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="okDelete" onclick="eliminarCliente()" class="btn btn-primary">Si</button>
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
	      			<div class="form-row">
				    	<div class="form-group col-md-4">
				      		<label >Codigo</label>
				      		<input type="number" class="form-control" id="codigoEdit" placeholder="Codigo">
					       	<div id="errorCod">
					      	</div>
				    	</div>
				    	<div class="form-group col-md-8">
					      <label >Razon Social</label>
					      <input type="text" class="form-control" id="nameEdit" placeholder="Razon Social">
					       <div id="errorRazon">
					      </div>
					    </div>				   
				  	</div>
				  	<div class="form-row">
					    <div class="form-group col-md-9">
					     	<label >Rut</label>
					      	<input type="number" class="form-control" id="rutEdit" id="rut" placeholder="Rut">
					      	<div id="errorRut">
					     	</div>				       
					    </div>
					    <div class="form-group col-md-3">
					    	<label style="visibility: hidden;">dv</label>			      
					      	<input type="text" class="form-control" id="dvEdit" placeholder="dv">
					       	<div id="errorDv">
					     	</div>
					    </div>
				 	</div>					 
				  	<div class="form-row">
					    <div class="form-group col-md-12">
					       	<label >Direccion</label>
					      	<input type="text" class="form-control" id="direccionEdit" placeholder="Direccion">
					       	<div id="errorDireccion">
					     	 </div>
					    </div>				   
				 	</div>
				 	<div class="form-row">
					    <div class="form-group col-md-6">
					    	<label >Vendedores</label>
					    	<div id="vendedoresList"></div>	
					    </div>	
					    <div class="form-group col-md-6">
					    	<label >Localidades</label>
					       	<div id = "localidadesList"></div>
					    </div>				   
				 	 </div>
				</form>				
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="okEditar" onclick="editarCliente()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script >
	//var user; // se vuelve global

	//ejecutar modales
	function modalEliminar(id){
		document.getElementById('okDelete').value = id;
		ajax_getCliente(id,'eliminar');
		$('#deleteModal').modal('show');
	}

	function modalEditar(id){
		$('#errorCod').html('<div></div>');
		$('#errorRazon').html('<div></div>');
		$('#errorRut').html('<div></div>');
		$('#errorDv').html('<div></div>');
		$('#errorDireccion').html('<div></div>');
		document.getElementById('okEditar').value = id;
		ajax_getCliente(id,'editar');
		$('#editarModal').modal('show');
	}

	//////////relleno de modales/////////////

	function llenarModalEliminar(cliente){
		document.getElementById('codigoDelete').value = cliente.codigo;
		document.getElementById('razonDelete').value = cliente.razon_social;
		document.getElementById('rutDelete').value = cliente.rut;
		document.getElementById('userDelete').value = cliente.user.codigo;
	}
	function llenarModalEditar(cliente){
		comboboxEdit(cliente.localidad_id, cliente.user_id);
		document.getElementById('codigoEdit').value = cliente.codigo;
		document.getElementById('nameEdit').value = cliente.razon_social;
		document.getElementById('rutEdit').value = cliente.rut;
		document.getElementById('dvEdit').value = cliente.dv;
		document.getElementById('direccionEdit').value = cliente.direccion;
	}
	function comboboxEdit(localidad_id, user_id){
 			$.ajax({
			method:"GET",
			url:'/api/vendedores/',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				var vendedores = resp.data;
				var opciones = '<select class="form-control" id="vendedoresComboEdit">';
				for (var i = 0; i < vendedores.length; i++) {
					if(vendedores[i]['id'] == user_id){
						opciones += '<option selected="selected" value="'+vendedores[i]['id']+'">'+vendedores[i]['codigo']+'</option>';
					}
					else{
						opciones += '<option value="'+vendedores[i]['id']+'">'+vendedores[i]['codigo']+'</option>';
					}
				}
				$('#vendedoresList').html(opciones+'</select>');			
			},
			error(error){				
				alert('vendedores no Encontrados');				
			}
		});

		$.ajax({
			method:"GET",
			url:'/api/localidades/',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				var localidades = resp.data;
				var opciones = '<select class="form-control" id="localidadesComboEdit">';
				for (var i = 0; i < localidades.length; i++) {
					if(localidades[i]['id'] == localidad_id){
						opciones += '<option selected="selected" value="'+localidades[i]['id']+'">'+localidades[i]['nombre']+'</option>';
					}
					else{
						opciones += '<option value="'+localidades[i]['id']+'">'+localidades[i]['nombre']+'</option>';
					}
				}
				$('#localidadesList').html(opciones+'</select>');		
			},
			error(error){				
				alert('localidades no Encontrados');				
			}
		});
 	}
	//llamar ajax
	function eliminarCliente(){
		var id = document.getElementById('okDelete').value;
		ajaxEliminar(id);
	}
	function editarCliente(){
		var id = document.getElementById('okEditar').value;
		var codigo = document.getElementById('codigoEdit').value ;
		var rut = document.getElementById('rutEdit').value;
		var dv = document.getElementById('dvEdit').value;
		var razon_social = document.getElementById('nameEdit').value;
		var direccion = document.getElementById('direccionEdit').value;
		var vendedor_id  = $('#vendedoresComboEdit option:selected').val();
		var localidad_id  = $('#localidadesComboEdit option:selected').val();

		ajaxEditar(id,codigo,rut,dv,razon_social,direccion,vendedor_id,localidad_id);	
	}
	

	//////////////funciones ajax//////////////
	function ajaxEditar(id,codigo,rut,dv,razon_social,direccion,vendedor_id,localidad_id){
		var data = {
			'codigo': codigo,
			'rut' : rut,
            'dv' : dv,
			'razon_social' : razon_social,
            'direccion' : direccion,
            'user_id' : vendedor_id,
            'localidad_id':localidad_id,
		};
		$.ajax({
			method:"PUT",
			url:'/api/clientes/'+ id,
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


	function ajax_getCliente(id,modal){
		$.ajax({
			method:"GET",
			url:'/api/clientes/'+id,
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
		$.ajax({
			method:"DELETE",
			url:'/api/clientes/'+ id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Cliente Eliminado Exitosamente');
					location.reload();
				}
			},
			error(error){
				alert('Cliente no puede ser Eliminada, constituye perdida de Datos');
				$('#deleteModal').modal('hide');
			}
		});
	}
	function incrustarErrores(errores){
		$('#errorRut').html('<div></div>');
		$('#errorDv').html('<div></div>');
		$('#errorDireccion').html('<div></div>');
		$('#errorCod').html('<div></div>');
		$('#errorRazon').html('<div></div>');
		if(errores.rut){
			console.log("entrando");
			$('#errorRut').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.rut[0]+
				'</div>'
				);
		}
		if(errores.dv){
			$('#errorDv').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.dv[0]+
				'</div>'
				);
		}
		if(errores.direccion){
			$('#errorDireccion').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.direccion[0]+
				'</div>'
				);
		}
		if(errores.razon_social){
			$('#errorRazon').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.razon_social[0]+
				'</div>'
				);
		}
		if(errores.codigo){
			$('#errorCod').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.codigo[0]+
				'</div>'
			);
		}
	}


	
</script>
