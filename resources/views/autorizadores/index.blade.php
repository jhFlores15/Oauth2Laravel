@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Autorizadores</h2>
		<br>		
		<div class="row" style="padding-left: 100px;">
			<form class="form-inline">  
			  	<div class="form-group mx-sm-3 mb-2">
			   	 	<label for="inputPassword2" class="sr-only">Nombre Autorizador</label>
			    	<input type="text" class="form-control"  id="nombreNew" placeholder="Nombre Autorizador">
			  	</div>
			  	<div id="saveRegion">
			  		<button type="button" onclick="guardarRegion()" class="btn btn-primary mb-2">Guardar</button>
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
		<table id="regiones" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th>Nombre</th>
					<th>&nbsp;</th>
				</tr>
			</thead>							
		</table>
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
 	function guardarRegion(){
		var nombre = document.getElementById('nombreNew').value;
		ajaxNew(nombre);
 	}

 	function ajaxNew(nombre){
 		$('#saveRegion').html('<div class="loader"></div>');
		var data = {
			'nombre' : nombre,
		};
		$.ajax({
			method:"POST",
			url:'/api/autorizadores',
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
					alertify.notify('Autorizador Creado', 'success', 3, function(){  console.log(); });  
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
		if(errores.nombre){
			$('#errorNombreNew').html(
				'<div class="alert alert-danger" role="alert">'+
				errores.nombre[0]+
				'</div>'
				);
		}
	}
 
 	$(document).ready(function(){
		var table = $('#regiones').DataTable(
			{
			'processing':true,
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/autorizadores_i/admin',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'nombre'},
				{data: 'btn'}
			],
			dom: 'Bfrtip',
			lengthMenu: [
	            [ -1 ],
	            ['Show all' ]
	        ],
	        buttons: [
	            'copy',
	            {
	            	extend: 'excel',
	            	title:'Aautorizadores',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'pdf',
	            	title:'Aautorizadores',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'print',
	            	title:'Aautorizadores',
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

