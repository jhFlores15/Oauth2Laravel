@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Comunas</h2>
		<br>		
		<div class="row" style="padding-left: 100px;">
			<form class="form-inline">			  
			  	<div class="form-group mx-sm-1 mb-1">
			   	 	<label for="inputPassword2" class="sr-only">Comuna</label>
			    	<input type="text" class="form-control"  id="comunaNew" placeholder="Comuna">
			  	</div>
			  	<div class="form-group mx-sm-3 mb-2">
			   	 	<div id="combobox">
		  			</div>	
			  	</div>
			  	<div id="saveRegion">
			  		<button type="button" onclick="guardarComuna()"  class="btn btn-primary mb-2">Guardar</button>	
			  	</div>			  	
			</form>			
		</div>	
		<div class="row" style="padding-left: 100px;">
			<form class="form-inline">		
			  	<div class="form-group mx-sm-3 mb-2">
			      	<div id="errorNombreNew"></div>
			  	</div>
			</form>
		</div>
		<table id="comunas" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th>Comuna</th>
					<th>Region</th>
					<th>&nbsp;</th>
				</tr>
			</thead>							
		</table>
	</div>
</div>
 <script >
 	window.onload = function() {
 		if(!localStorage.getItem('access_token'))
 		{
 			location.href = '/';
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
					console.log(resp);
					console.log(resp.rol_id);
					if(resp.rol_id != 1){
						location.href = '/';
					}	
					else{
						combobox();
					}		
				},
				error(error){							
				}
	 		});
 	}
 	

 	function guardarComuna(){
		var comuna = document.getElementById('comunaNew').value;
		var region_id  = $('#combobox option:selected').val();
		ajaxNew(comuna,region_id);
 	}

 	function ajaxNew(comuna,region_id){
 		$('#saveRegion').html('<div class="loader"></div>');
		var data = {
			'nombre' : comuna,
			'region_id' : region_id,
		};
		$.ajax({
			method:"POST",
			url:'/api/comunas',
			data: JSON.stringify(data),
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				$('#saveRegion').html('<button type="button" onclick="guardarComuna()" class="btn btn-primary mb-2">Guardar</button>');
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Comuna Creada', 'success', 3, function(){  console.log(); });  
					location.reload(true);
				}
			},
			error(error){	
				$('#saveRegion').html('<button type="button" onclick="guardarComuna()" class="btn btn-primary mb-2">Guardar</button>');
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
 		$('#errorNombreNew').html('<div></div>');
 		console.log("error");		
		if(errores.nombre){
			$('#errorNombreNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.nombre[0]+
				'</div>'
				);
		}		
	}
 
 	$(document).ready(function(){

 		if(!localStorage.getItem('access_token'))
 		{
 			location.href = 'http://localhost:3000/';
 		}

		var table = $('#comunas').DataTable(
			{
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/comunas',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'nombre'},
				{data: 'region.nombre'},
				{data: 'btn'}
			],
			dom: 'Bfrtip',
			lengthMenu: [
	            [ 10, 25, 50, -1 ],
	            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
	        ],
	        buttons: [
	            'copy',
	            {
	            	extend: 'excel',
	            	title:'Clientes Encuestados',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'pdf',
	            	title:'Clientes Encuestados',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'print',
	            	title:'Clientes Encuestados',
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
	});


	function combobox(){
 		$.ajax({
			method:"GET",
			url:'/api/regiones/',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				var regiones = resp.data;
				var opciones = '<select class="form-control" id="combobox">';
				for (var i = 0; i < regiones.length; i++) {
					opciones += '<option value="'+regiones[i]['id']+'">'+regiones[i]['nombre']+'</option>';
				}
				$('#combobox').html(opciones+'</select>');		
			},
			error(error){				
				alert('Regiones no Encontradas');
				$('#deleteModal').modal('hide');				
			}
		});
 	}

		
 </script>
 <style>
 	td.highlight{
 		background-color: whitesmoke !important;
 	}
 </style>
@endsection

