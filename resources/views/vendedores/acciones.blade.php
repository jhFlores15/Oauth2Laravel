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
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Vendedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">
      		<div class="row text-center">
      		<h5>¿Desea eliminar a este Vendedor?</h5>
	      	</div>
	      	<div class="row text-center">
	      		<form>	   
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Codigo</label>
					    <div class="col-md-8">
					      <input type="text" readonly class="form-control-plaintext" id="CodDelete" value="">
					    </div>
				  </div>   			
				  <div class="form-group row">
				    <label for="staticEmail" class="col-md-4 col-form-label">Rut</label>
				    <div class="col-md-8">
				      <input type="text" readonly class="form-control-plaintext" id="rutDelete" value="">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-md-4 col-form-label">Nombre</label>
				    <div class="col-md-8">
				      <input type="text" readonly class="form-control-plaintext" id="nameDelete" value="">
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="staticEmail" class="col-md-4 col-form-label">Email</label>
				    <div class="col-md-8">
				      <input type="text" readonly class="form-control-plaintext" id="emailDelete" value="">
				    </div>
				  </div>
				  {{-- <div class="form-group row">
				    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
				    <div class="col-sm-10">
				      <input type="password" class="form-control" id="inputPassword" placeholder="Password">
				    </div>
				  </div> --}}
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="okDelete" onclick="eliminarUsuario()" class="btn btn-primary">Si</button>
      </div>
    </div>
  </div>
</div>


<!-- //////////////////////////////////Modal Editar//////////////////////////-->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Vendedor</h5>
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
				      		<label >Codigo</label>
				      		<input type="number" class="form-control" id="codigoEdit" placeholder="Codigo">
				       	<div id="errorCod">
				      	</div>
				    	</div>				   
				  	</div>
				  <div class="form-row">
				    <div class="form-group col-md-9">
				      <label for="inputEmail4">Rut</label>
				      <input type="number" class="form-control" id="rutEdit" placeholder="Rut">
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
				      <label for="inputEmail4">Editar</label>
				      <input type="text" class="form-control" id="nameEdit" placeholder="Editar">
				       <div id="errorRazon">
				      </div>
				    </div>				   
				  </div>
				  <div class="form-row">
				    <div class="form-group col-md-12">
				       <label for="inputEmail4">Email</label>
				      <input type="email" class="form-control" id="emailEdit" placeholder="Email">
				       <div id="errorEmail">
				      </div>
				    </div>				   
				  </div>
				  <div class="form-row">
				    <div class="form-group col-md-10">
				      <label for="inputEmail4">Password</label>
				      <input type="text" class="form-control" id="passwordEdit2" placeholder="Password">
				       <div id="errorPass">
				      </div>
				    </div>				   
				  </div>
				  
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="okEditar" onclick="editarUsuario()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
<script >
	//var user; // se vuelve global

	//ejecutar modales
	function modalEliminar(id){
		document.getElementById('okDelete').value = id;
		ajax_GetUser(id,'eliminar');
		$('#deleteModal').modal('show');
	}

	function modalEditar(id){
		$('#errorRut').html('<div></div>');
		$('#errorDv').html('<div></div>');
		$('#errorEmail').html('<div></div>');
		$('#errorRazon').html('<div></div>');
		$('#errorPass').html('<div></div>');
		$('#errorCod').html('<div></div>');
		document.getElementById('okEditar').value = id;
		ajax_GetUser(id,'editar');
		$('#editarModal').modal('show');
	}

	//////////relleno de modales/////////////

	function llenarModalEliminar(user){
		document.getElementById('CodDelete').value = user.codigo;
		document.getElementById('rutDelete').value = user.rut;
		document.getElementById('nameDelete').value = user.razon_social;
		document.getElementById('emailDelete').value = user.email;
	}
	function llenarModalEditar(user){
		document.getElementById('rutEdit').value = user.rut;
		document.getElementById('dvEdit').value = user.dv;
		document.getElementById('nameEdit').value = user.razon_social;
		document.getElementById('emailEdit').value = user.email;
		document.getElementById('passwordEdit2').value = user.password_visible;
		document.getElementById('codigoEdit').value = user.codigo;
	}

	//llamar ajax
	function eliminarUsuario(){
		var id = document.getElementById('okDelete').value;
		console.log("eliminando " + id);
		ajaxEliminar(id);
	}
	function editarUsuario(){
		var id = document.getElementById('okEditar').value;
		var rut = document.getElementById('rutEdit').value;
		var dv = document.getElementById('dvEdit').value;
		var razon_social = document.getElementById('nameEdit').value;
		var email = document.getElementById('emailEdit').value;
		var password = document.getElementById('passwordEdit2').value ;
		var codigo = document.getElementById('codigoEdit').value;
		console.log("editando " + id);
		ajaxEditar(id,rut,dv,razon_social,email,password,codigo);		
	}
	

	//////////////funciones ajax//////////////
	function ajaxEditar(id,rut,dv,razon_social,email,password,codigo){
		console.log("lo que recibe ajax"+rut);
		var data = {
			'razon_social' : razon_social,
            'email' : email,
            'password' : password,
            'rut' : rut,
            'dv' : dv,
            'codigo' : codigo,
		};
		$.ajax({
			method:"PUT",
			url:'/api/auth/update/'+ id,
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


	function ajax_GetUser(id,modal){
		$.ajax({
			method:"GET",
			url:'/api/usuarios/'+id,
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
				alert('Usuario no Encontrado');
				$('#deleteModal').modal('hide');
				
				
			}
		});
	}

	function ajaxEliminar(id){
		$.ajax({
			method:"DELETE",
			url:'/api/usuarios/'+ id,
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Eliminado Exitosamente');
					location.reload();
				}
			},
			error(error){
				alert('Usuario no puede ser Eliminado, constituye perdida de Datos');
				$('#deleteModal').modal('hide');
			}
		});
	}
	function incrustarErrores(errores){
		$('#errorRut').html('<div></div>');
		$('#errorDv').html('<div></div>');
		$('#errorEmail').html('<div></div>');
		$('#errorRazon').html('<div></div>');
		$('#errorPass').html('<div></div>');
		$('#errorCod').html('<div></div>');
		if(errores.rut){
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
		if(errores.email){
			$('#errorEmail').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.email[0]+
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
		if(errores.password){
			$('#errorPass').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.password[0]+
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
