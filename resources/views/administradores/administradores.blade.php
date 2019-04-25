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
			<button type="button" onclick="showData()" class="btn btn-primary ">
			   Mostrar Table
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
	        <button type="button" onclick="okUsuario()" class="btn btn-primary">Guardar</button>
	      </div>
	    	</div>
	  	</div>
	</div>
</div>
 <script >
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
		console.log("lo que recibe ajax"+rut);
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
				console.log(resp);
				if(resp == 'ok'){
					alert('Administrador Creado');
					location.reload(true);
				}
			},
			error(error){
				var errores = error.responseJSON.error;
				incrustarErroresNew(errores);	
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
		if(errores['rut']){
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
	}
 
 	$(document).ready(function(){

 		if(!localStorage.getItem('access_token'))
 		{
 			location.href = 'http://localhost:3000/';
 		}

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
			"language":{
				"info":"_TOTAL_ registros",
				"search": "Buscar",
				"paginate":{
					"next":"Siguiente",
					"previous":"Anterior",
					"first": "Primero",
					"last" : "Ultimo"
				},
				"lengthMenu":'Mostrar <select>'+
								'<option value="2">2</option>'+
								'<option value="30">30</option>'+
								'<option value="60">60</option>'+
								'<option value="-1">Todos</option>'+
								'</select> registros',
				"loadingRecords": "Cargando...",
				"processing":"Procesando...",
				"emptyTable":"No hay datos...",
				"zeroRecords": "No hay coincidencias",
				"infoEmpty": "iz",
				"infoFiltered": "de",

			},
			"pagingType": "full_numbers",
			'dom': 'Bfrtip',
			'buttons':[
				'copy','excel','pdf'
			],
		});

		table.buttons().container().appendTo($('.col-sm-sm-6:eq(0)',table.table().container()));

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

