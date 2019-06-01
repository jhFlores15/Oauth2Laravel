@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Encuestas</h2>
		<br>	
		<div class="row text-center" style="padding-left: 100px;">
			<a type="button" href="/encuestas/create" class="btn btn-primary ">Crear Encuesta</a>
		</div>			
		<table id="comunas" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th>ID</th>
					<th>Descripcion</th>
					<th>Estado</th>
					<th>Tipo de Encuesta</th>
					<th>Inicio</th>
					<th>Termino</th>
					<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
				</tr>
			</thead>							
		</table>
	</div>
</div>
 <script >

 	$(document).ready(function(){
 		window.onload = function() {
	 		if(!localStorage.getItem('access_token'))
	 		{
	 			window.location.href = '/',true;
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
							window.location = '/';
						}
							
					},
					error(error){							
					}
		 		});
	 	}

		var table = $('#comunas').DataTable(
			{
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/encuestas',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'id'},
				{data: 'descripcion'},
				{data: 'estado'},
				{data: 'tipo_encuesta.nombre'},
				{data: 'inicio'},
				{data: 'termino'},
				{data: 'btn'},
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

