@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Regiones</h2>
		<br>		
		<div class="row" style="padding-left: 100px;">
			<form class="form-inline">			  
			  	<div class="form-group mx-sm-1 mb-1">
			   	 	<label for="inputPassword2" class="sr-only">Numero de Region</label>
			    	<input type="number" class="form-control"  id="numeroNew" placeholder="Numero">
			  	</div>
			  	<div class="form-group mx-sm-3 mb-2">
			   	 	<label for="inputPassword2" class="sr-only">Nombre Region</label>
			    	<input type="text" class="form-control"  id="nombreNew" placeholder="Region">
			  	</div>
			  	<div id="saveRegion">
			  		<button type="button" onclick="guardarRegion()" class="btn btn-primary mb-2">Guardar</button>
			  	</div>
			  		
			  	
			</form>			
		</div>	
		<div class="row" style="padding-left: 100px;">
			<form class="form-inline">			  
			  	<div class="form-group mx-sm-3 mb-2">
			  		<div id="errorNumeroNew"></div>			      
			  	</div>
			  	<div class="form-group mx-sm-3 mb-2">
			      	<div id="errorNombreNew"></div>
			  	</div>
			</form>
		</div>
		<table id="regiones" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th>Numero</th>
					<th>Nombre</th>
					<th>&nbsp;</th>
				</tr>
			</thead>							
		</table>
	</div>
</div>
 <script >
 	function guardarRegion(){
		var nombre = document.getElementById('nombreNew').value;
		var numero = document.getElementById('numeroNew').value;
		ajaxNew(nombre,numero);
 	}

 	function ajaxNew(nombre,numero){
 		$('#saveRegion').html('<div class="loader"></div>');
		var data = {
			'nombre' : nombre,
			'numero' : numero,
		};
		$.ajax({
			method:"POST",
			url:'/api/regiones',
			data: JSON.stringify(data),
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				$('#saveRegion').html('<button type="button" onclick="guardarRegion()" class="btn btn-primary mb-2">Guardar</button>');
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
					alertify.notify('Region Creada', 'success', 3, function(){  console.log(); });  
					location.reload(true);
				}
			},
			error(error){
				$('#saveRegion').html('<button type="button" onclick="guardarRegion()" class="btn btn-primary mb-2">Guardar</button>');
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
		$('#errorNombreNew').html('<div></div>');
		$('#errorNumeroNew').html('<div></div>');
		if(errores.nombre){
			$('#errorNombreNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.nombre[0]+
				'</div>'
				);
		}
		if(errores.numero){
			$('#errorNumeroNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.numero[0]+
				'</div>'
				);
		}
	}
 
 	$(document).ready(function(){

 		if(!localStorage.getItem('access_token'))
 		{
 			location.href = 'http://localhost:3000/';
 		}

		var table = $('#regiones').DataTable(
			{
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/regiones',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'numero'},
				{data: 'nombre'},
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

		
 </script>
 <style>
 	td.highlight{
 		background-color: whitesmoke !important;
 	} 	
 </style>
@endsection

