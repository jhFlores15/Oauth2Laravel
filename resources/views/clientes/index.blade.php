@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div  id="" class="justify-content-center text-center">
		<h2 class="text-center">Clientes</h2>
		<br>
		<div class="row text-center" style="padding-left: 100px;">
			<div class="col-md-4">
				<button type="button" onclick="nuevoCliente()" class="btn btn-primary ">
				   Agregar Nuevo Cliente
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
					  	  	<div class="input-group-prepend">
					    		 <button type="button" onclick="postDatos()" class="btn btn-outline-success mb-2">Subir Datos</button>
					    	</div>					  
						</div>
						
					</div>
				</form>
				<div class="col-md-7">
					<table class="table table-bordered table-sm">
				    <thead>
				      <tr>
				        <th>codigo</th>
				        <th>rut</th>
				        <th>dv</th>
				        <th>razon_social</th>
				        <th>direccion</th>
				        <th>comuna</th>
				        <th>cod_vendedor</th>
				      </tr>
				    </thead>			    
				  </table>
				</div>
			</div>
		</div>	
			<table id="clientes" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
				<thead> 
					<tr>
						<th>Codigo</th>
						<th>Razon Social</th>
						<th>Rut</th>
						<th>dv</th>
						<th>Vendedor</th>
						<th>Direccion</th>
						<th>Comuna</th>						
						<th>Registro</th>
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
	        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
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
					      		<input type="number" class="form-control" id="codigoNew" placeholder="Codigo">
						       	<div id="errorCodNew">
						      	</div>
					    	</div>
					    	<div class="form-group col-md-8">
						      <label >Razon Social</label>
						      <input type="text" class="form-control" id="nameNew" placeholder="Razon Social">
						       <div id="errorRazonNew">
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
						       	<label >Direccion</label>
						      	<input type="text" class="form-control" id="direccionNew" placeholder="Direccion">
						       	<div id="errorDireccionNew">
						     	 </div>
						    </div>				   
					 	 </div>
					 	 <div class="form-row">
						    <div class="form-group col-md-6">
						    	<label >Vendedores</label>
						    	<div id="listVendedores"></div>	
						    </div>	
						    <div class="form-group col-md-6">
						    	<label >Comunas</label>
						       	<div id = "listComunas"></div>
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
 	$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	function postDatos(){
		var file = $('#file')[0].files[0];
		console.log(file);
		let formData = new FormData();            
        formData.append('file', file);
		console.log(formData);
		$.ajax({
			method:"POST",
			url:'/api/clientes/file',
			data: formData,
			processData: false,
			contentType: false,
			headers : {
				// 'Content-Type': 'multipart/form-data',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Datos Actualizados correctamente');
					location.reload(true);
				}
			},
			error(error){
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
					alert('ah Ocurrido un error, los datos no se han actualizado Correctamente');
					console.log(error.responseJSON);
				}
			}
		});
	}
	
 	window.onload = function(){
 		combobox();
 	}

	function combobox(){
 		$.ajax({
			method:"GET",
			url:'/api/vendedores/',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				var vendedores = resp.data;
				var opciones = '<select class="form-control" id="vendedoresCombo">';
				for (var i = 0; i < vendedores.length; i++) {
					opciones += '<option value="'+vendedores[i]['id']+'">'+vendedores[i]['codigo']+'</option>';
				}
				$('#listVendedores').html(opciones+'</select>');			
			},
			error(error){				
				alert('vendedores no Encontrados');				
			}
		});

		$.ajax({
			method:"GET",
			url:'/api/comunas/',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				var comunas = resp.data;
				var opciones = '<select class="form-control" id="ComunasCombo">';
				for (var i = 0; i < comunas.length; i++) {
					opciones += '<option value="'+comunas[i]['id']+'">'+comunas[i]['nombre']+'</option>';
				}
				$('#listComunas').html(opciones+'</select>');		
			},
			error(error){				
				alert('comunas no Encontrados');				
			}
		});
 	}

 	function nuevoCliente(){
 		$('#errorRutNew').html('<div></div>');
		$('#errorDvNew').html('<div></div>');
		$('#errorRazonNew').html('<div></div>');
		$('#errorDireccionNew').html('<div></div>');
		$('#errorCodNew').html('<div></div>');
 		$('#nuevoUModal').modal('show');

 	}
 	function okUsuario(){
 		var codigo = document.getElementById('codigoNew').value ;
		var rut = document.getElementById('rutNew').value;
		var dv = document.getElementById('dvNew').value;
		var razon_social = document.getElementById('nameNew').value;
		var direccion = document.getElementById('direccionNew').value;

		var vendedor_id  = $('#listVendedores option:selected').val();
		var comuna_id  = $('#listComunas option:selected').val();

		ajaxNew(codigo,rut,dv,razon_social,direccion,vendedor_id,comuna_id);
 	}

 	function ajaxNew(codigo,rut,dv,razon_social,direccion,vendedor_id,comuna_id){
		var data = {
			'codigo': codigo,
			'rut' : rut,
            'dv' : dv,
			'razon_social' : razon_social,
            'direccion' : direccion,
            'user_id' : vendedor_id,
            'comuna_id':comuna_id,
		};
		$.ajax({
			method:"POST",
			url:'/api/clientes',
			data: JSON.stringify(data),
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Cliente Creado');
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
 		$('#errorRutNew').html('<div></div>');
		$('#errorDvNew').html('<div></div>');
		$('#errorDireccionNew').html('<div></div>');
		$('#errorCodNew').html('<div></div>');
		$('#errorRazonNew').html('<div></div>');
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
		if(errores.direccion){
			$('#errorDireccionNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.direccion[0]+
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
		if(errores.codigo){
			$('#errorCodNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.codigo[0]+
				'</div>'
			);
		}
	}
 
 	$(document).ready(function(){

 		if(!localStorage.getItem('access_token'))
 		{
 			location.href = 'http://localhost:3000/';
 		}

		var table = $('#clientes').DataTable(
			{
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/clientes',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'codigo'},
				{data: 'razon_social'},
				{data: 'rut'},
				{data: 'dv'},
				{data:'vendedor.codigo'},
				{data:'direccion'},
				{data:'comuna.nombre'},
				{data:'created_at'},
				{data: 'btn'},
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
				"lengthMenu":'Mostrar <select class="form-control">'+
								'<option value="10">10</option>'+
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
		});

	
});
		
 </script>

@endsection

