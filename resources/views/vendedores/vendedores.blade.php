@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div  id="" class="justify-content-center text-center">
		<h2 class="text-center">Vendedores</h2>
		<br>
		<div class="row text-center" style="padding-left: 100px;">
			<div class="col-md-4">
				<button type="button" onclick="nuevoAdministrador()" class="btn btn-primary ">
			   Agregar Nuevo Vendedor
			</button>
			</div>
			<div class="col-md-7 text-center">
				<div id="errorFile"></div>
				<form class="form-inline">
					<div class="form-group">
						<div class="input-group mb-3">
						  	<div class="input-group-prepend">
					    		<img src="https://img.icons8.com/color/40/000000/ms-excel.png">						   
						  	</div>
						  	<div class="custom-file">
						    	<input type="file" id="file" ref="file" class="custom-file-input" name="csv" v-on:change="handleFileUpload()"  required accept=".csv,.xlsx" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
						    	<label class="custom-file-label" data-browse="Examinar" for="inputGroupFile01" >Archivo XLSX &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						  	</div>
						  	<div id="postDatosSub">
						  		<div class="input-group-prepend" >
						    		 <button type="button"  onclick="postDatos()" class="btn btn-outline-success mb-2">Subir Datos</button>
						    	</div>								  		
						  	</div>
					  	  				  
						</div>
						
					</div>
				</form>
				<div class="row">
					<div class="col-md-7">
						<table class="table table-bordered table-sm">
					    <thead>
					      <tr>
					        <th>codigo</th>
					        <th>rut</th>
					        <th>dv</th>
					        <th>nombre</th>
					        <th>email</th>
					        <th>password</th>
					      </tr>
					    </thead>			    
					  </table>
					</div>
					<div class="col-md-5">
						 <label><b>Rut sin puntos , y sin espacios para todos los campos menos para nombre</b></label>
					</div>					
				</div>
			</div>		
			</div>			

		</div>	
			<table id="administradores" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
				<thead> 
					<tr>
						<th>Codigo</th>
						<th>Nombre</th>
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
	        <h5 class="modal-title" id="exampleModalLabel">Nuevo Vendedor</h5>
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
					      		<input type="number" class="form-control" id="codigoNew" placeholder="Codigo">
					       	<div id="errorCodNew">
					      	</div>
					    	</div>				   
					  	</div>
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
					      <label > Nombre </label>
					      <input type="text" class="form-control" id="nameNew" placeholder="Nombre">
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
	        <div id="okUsuario1" >
	        	<button type="button" onclick="okUsuario()" class="btn btn-primary">Guardar</button>
	        </div>
	        
	      </div>
	    	</div>
	  	</div>
	</div>
</div>
 <script >
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
					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
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
 		$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	function postDatos(){
		$('#postDatosSub').html('<div class="loader"></div>');
		var file = $('#file')[0].files[0];
		console.log(file);
		let formData = new FormData();            
        formData.append('file', file);
		console.log(formData);
		$.ajax({
			method:"POST",
			url:'/api/usuarios',
			data: formData,
			processData: false,
			contentType: false,
			headers : {
				// 'Content-Type': 'multipart/form-data',
				'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
			},
			success:function(resp){	
				$('#postDatosSub').html('<button type="button" onclick="postDatos()" class="btn btn-outline-success mb-2">Subir Datos</button>');
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Datos Actualizados Correctamente', 'success', 3, function(){  console.log(); });
					location.reload(true);
					
				}
			},
			error(error){
				$('#postDatosSub').html('<button type="button" onclick="postDatos()" class="btn btn-outline-success mb-2">Subir Datos</button>');
				if(error.status == 422){
					var errores = error.responseJSON.error;
					$('#errorFile').html('<div></div>');
			 		console.log("error");		
					if(errores.file){
						$('#errorFile').html(
							'<div class="alert alert-danger" role="alert">'+
							errores.file[0]+
							'</div>'
							);
					}	
				}
				else{
					alertify.set('notifier','position', 'top-right');
					alertify.notify('ah Ocurrido un error, los datos no se han actualizado Correctamente', 'error', 8, function(){  console.log(); });
					console.log(error.responseJSON);
				}
			}
		});
		
	}
 	function nuevoAdministrador(){
 		$('#errorRutNew').html('<div></div>');
		$('#errorDvNew').html('<div></div>');
		$('#errorEmailNew').html('<div></div>');
		$('#errorRazonNew').html('<div></div>');
		$('#errorPassNew').html('<div></div>');
		$('#errorCodNew').html('<div></div>');
 		$('#nuevoUModal').modal('show');

 	}
 	function okUsuario(){
		var rut = document.getElementById('rutNew').value;
		var dv = document.getElementById('dvNew').value;
		var razon_social = document.getElementById('nameNew').value;
		var email = document.getElementById('emailNew').value;
		var password = document.getElementById('passwordNew').value ;
		var codigo = document.getElementById('codigoNew').value ;
		ajaxNew(rut,dv,razon_social,email,password,codigo);
 	}

 	function ajaxNew(rut,dv,razon_social,email,password,codigo){
		$('#okUsuario1').html('<div class="loader"></div>');
		var data = {
			'razon_social' : razon_social,
            'email' : email,
            'password' : password,
            'rut' : rut,
            'dv' : dv,
            'codigo': codigo,
            'tipo_usuario' : 'Vendedor',
		};
		$.ajax({
			method:"POST",
			url:'/api/auth/signup',
			data: JSON.stringify(data),
			headers : {
				'Content-Type': 'application/json',
				'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
			},
			success:function(resp){	
				$('#okUsuario1').html('<button type="button" onclick="okUsuario1()" class="btn btn-primary">Guardar</button>');	
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Vendedor Registrado Correctamente', 'success', 4, function(){  console.log(); });
					location.reload(true);
				}
			},
			error(error){
				$('#okUsuario1').html('<button type="button" onclick="okUsuario1()" class="btn btn-primary">Guardar</button>');	
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
 		console.log("error");
		$('#errorRutNew').html('<div></div>');
		$('#errorDvNew').html('<div></div>');
		$('#errorEmailNew').html('<div></div>');
		$('#errorRazonNew').html('<div></div>');
		$('#errorPassNew').html('<div></div>');
		$('#errorCodNew').html('<div></div>');
		if(errores.rut){
			console.log("entrando");
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
		if(errores.codigo){
			$('#errorPassNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.codigo[0]+
				'</div>'
			);
		}
	}
 
 	$(document).ready(function(){

		var table = $('#administradores').DataTable(
			{
			"processing":true,
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/vendedores',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'codigo'},
				{data: 'razon_social'},
				{data: 'email'},
				{data: 'rut'},
				{data:'password_visible'},
				{data: 'btn'}
			],
			dom: 'Bfrtip',
			lengthMenu: [
	            [  -1 ],
	            ['Show all' ]
	        ],
	        buttons: [
	            'copy',
	            {
	            	extend: 'excel',
	            	title:'Vendedores',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'pdf',
	            	title:'Vendedores',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'print',
	            	title:'Vendedores',
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
 	.loader {
	  border: 10px solid #f3f3f3;
	  border-radius: 100%;
	  border-top: 10px solid #3498db;
	  border-bottom: 10px solid #3498db;
	  width: 40px;
	  height: 40px;
	  -webkit-animation: spin 2s linear infinite;
	  animation: spin 2s linear infinite;
	}

	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}
 </style>


@endsection

