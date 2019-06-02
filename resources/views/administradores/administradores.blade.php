@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div  id="" class="justify-content-center text-center">
		<h2 class="text-center">Administradores</h2>
		<br>
		<div class="row text-center" style="padding-left: 100px;">
			<button type="button" onclick="nuevoAdministrador()" class="btn btn-primary ">
			   Agregar Nuevo Administrador
			</button>
		</div>	
			<table id="administradores" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
				<thead> 
					<tr>
						<th>Razon Social</th>
						<th>Email</th>
						<th>Rut</th>
						<th>password</th>
						<th>&nbsp;</th>
					</tr>
				</thead>							
			</table>  
	</div>



	<!-- MODAL agregar Admin -->
	<div class="modal fade" id="nuevoUModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Nuevo Administrador</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body text-center">
	      	<div class="container-fluid text-center">      		
		      	<div class="row text-center">
		      		<form>
					  <div class="form-row">
					    <div class="form-group col-md-9">
					      <label >Rut</label>
					      <input type="number" class="form-control" id="rutNew" id="rut" placeholder="Rut">
					      <div id="errorRutNew">
					      </div>				       
					    </div>
					    <div class="form-group col-md-3">
					    <label style="visibility: hidden;">dv</label>			      
					      <input type="text" class="form-control" id="dvNew" placeholder="dv">
					       <div id="errorDvNew">
					      </div>
					    </div>
					  </div>
					  <div class="form-row">
					    <div class="form-group col-md-12">
					      <label >Razon Social</label>
					      <input type="text" class="form-control" id="nameNew" placeholder="Razon Social">
					       <div id="errorRazonNew">
					      </div>
					    </div>				   
					  </div>
					  <div class="form-row">
					    <div class="form-group col-md-12">
					       <label >Email</label>
					      <input type="email" class="form-control" id="emailNew" placeholder="Email">
					       <div id="errorEmailNew">
					      </div>
					    </div>				   
					  </div>
					  <div class="form-row">
					    <div class="form-group col-md-10">
					      <label for="inputEmail4">Password</label>
					      <input   class="form-control" id="passwordNew" placeholder="Password">
					       <div id="errorPassNew">
					      </div>
					    </div>
					    <div class="form-group col-md-2">
					    	<label style="visibility: hidden;">visibility</label>
					    	<input type="checkbox" checked="true" class="form-control" id="checkboxNew">	
					    </div>
					  </div>
					  
					</form>
		      	</div>      		
	      	</div>        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <div id="okUsuarioGuardarLoader">
	        	<button type="button" id="okUsuarioGuardar"onclick="okUsuario()" class="btn btn-primary">Guardar</button>
	        </div>
	        
	      </div>
	    	</div>
	  	</div>
	</div>
</div>

 <script type="text/javascript"  >
	window.onload = function() {
 		if((localStorage.getItem('access_token') == '') || !localStorage.getItem('access_token'))
 		{
 			window.location.href = '/';
 		}
 		else{
 			isAdmin();
	 	}
	};
 	function isAdmin(){
 		$.ajax({
				method:"GET",
				url:'/api/user/',
				headers : {
					'Content-Type': 'application/json',
					'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
				},
				success:function(resp){						
					if(resp.rol_id != 1){
						window.location.href = '/';
					}
						
				},
				error(error){							
				}
	 		});
 	}


 	function nuevoAdministrador(){
 		$('#errorRutNew').html('<div></div>');
		$('#errorDvNew').html('<div></div>');
		$('#errorEmailNew').html('<div></div>');
		$('#errorRazonNew').html('<div></div>');
		$('#errorPassNew').html('<div></div>');
 		$('#nuevoUModal').modal('show');

 	}
 	function okUsuario(){
		var rut = document.getElementById('rutNew').value;
		var dv = document.getElementById('dvNew').value;
		var razon_social = document.getElementById('nameNew').value;
		var email = document.getElementById('emailNew').value;
		var password = document.getElementById('passwordNew').value ;
		ajaxNew(rut,dv,razon_social,email,password);
 	}

 	function ajaxNew(rut,dv,razon_social,email,password){
		$('#okUsuarioGuardarLoader').html('<div class="loader"></div>');
		var data = {
			'razon_social' : razon_social,
            'email' : email,
            'password' : password,
            'rut' : rut,
            'dv' : dv,
            'tipo_usuario' : 'Administrador',
		};
		$.ajax({
			method:"POST",
			url:'/api/auth/signup',
			data: JSON.stringify(data),
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				$('#okUsuarioGuardarLoader').html('<button type="button" id="okUsuarioGuardar"onclick="okUsuario()" class="btn btn-primary">Guardar</button>');
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Administrador Creado', 'success', 3, function(){  console.log(); });  
					location.reload(true);
				}
			},
			error(error){
				$('#okUsuarioGuardarLoader').html('<button type="button" id="okUsuarioGuardar"onclick="okUsuario()" class="btn btn-primary">Guardar</button>');
				if(error.status == 422){
					var errores = error.responseJSON.error;
					incrustarErroresNew(errores);	
				}
				else{
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Error', 'error', 3, function(){  console.log(); });  
				}
			}
		});
		
	}

 	function incrustarErroresNew(errores){
		$('#errorRutNew').html('<div></div>');
		$('#errorDvNew').html('<div></div>');
		$('#errorEmailNew').html('<div></div>');
		$('#errorRazonNew').html('<div></div>');
		$('#errorPassNew').html('<div></div>');
		if(errores['rut']){
			$('#errorRutNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.rut[0]+
				'</div>'
				);
		}
		if(errores.dv){
			$('#errorDvNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.dv[0]+
				'</div>'
				);
		}
		if(errores.email){
			$('#errorEmailNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.email[0]+
				'</div>'
				);
		}
		if(errores.razon_social){
			$('#errorRazonNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.razon_social[0]+
				'</div>'
				);
		}
		if(errores.password){
			$('#errorPassNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.password[0]+
				'</div>'
				);
		}
	}
 
 	$(document).ready(function(){

		var table = $('#administradores').DataTable(
			{
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/administradores',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'razon_social'},
				{data: 'email'},
				{data: 'rut'},
				{data:'password_visible'},
				{data: 'btn'}
			],
			dom: 'Bfrtip',
			lengthMenu: [
	            [-1 ],
	            [  'Show all' ]
	        ],
	        buttons: [
	            'copy',
	            {
	            	extend: 'excel',
	            	title:'Administradores ',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'pdf',
	            	title:'Administradores',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'print',
	            	title:'Administradores',
	            	exportOptions: {
	                    columns: ':visible'
	                },autoFilter: true,
	            }, 
	            {
	            	extend: 'colvis',
	            	text: 'Seleccionar Columnas',
	            	collectionLayout: 'fixed two-column',
	            },
	            'pageLength',
	        ],
			"language":{
				"info":"_TOTAL_ registros",
				"search": "Buscar",
				"paginate":{
					"next":"Siguiente",
					"previous":"Anterior",
					"first": "Primero",
					"last" : "Ultimo"
				},
				
				"loadingRecords": "Cargando...",
				"processing":"Procesando...",
				"emptyTable":"No hay datos...",
				"zeroRecords": "No hay coincidencias",
				"infoEmpty": "iz",
				"infoFiltered": "de",
				"buttons":{
					 copyTitle: 'Copiado al Portapapeles',
					 copySuccess: {
	                    _: '%d lineas copiadas',
	                    1: '1 linea copiada'
	                }
				},

			},
			"pagingType": "full_numbers",
			});	

		//table.buttons().container().appendTo($('.col-sm-sm-6:eq(0)',table.table().container()));

	//////////  Ver Password //////////////
		var togglePassword2= document.getElementById('checkboxNew');
		var showOrHidePassword2 = () =>{
			var password = document.getElementById('passwordNew');
			if(password.type == 'password'){
				password.type = 'text';
			}
			else{
				password.type= 'password';
			}
		}
		togglePassword2.addEventListener('change',showOrHidePassword2);
		
	});

		
 </script>
 <style>
 	td.highlight{
 		background-color: whitesmoke !important;
 	}
 </style>
@endsection


