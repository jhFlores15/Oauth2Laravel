@extends('master')

@section('dataTable')

<div class="container-fluid" >
	<br>

	<div class="justify-content-center text-center">
		<h2 class="text-center">Encuestas</h2>
		<br>					
		<table id="comunas" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th>Descripcion</th>					
					<th>&nbsp;</th>
					<th>Tipo de Encuesta</th>
					<th>Inicio</th>					
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
					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
				},
				success:function(resp){						
					if(resp.rol_id != 2){
						window.location.href = '/';
					}
						
				},
				error(error){							
				}
	 		});
 	}
 	$(document).ready(function(){
		 	

		var table = $('#comunas').DataTable(
			{
			"processing":true,
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/encuesta/vendedor',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[				
				{data: 'descripcion'},
				{data: 'btn'},
				{data: 'tipo_encuesta.nombre'},
				{data: 'inicio'},
				
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
								'<option value="10">10</option>'+
								'<option value="30">30</option>'+
								'<option value="60">60</option>'+
								'<option value="-1">Todos</option>'+
								'</select> registros',
				"loadingRecords": "Cargando...",
				"processing":"Procesando...",
				"emptyTable":"No hay Encuestas que realizar por el momento...",
				"zeroRecords": "No hay coincidencias",
				"infoEmpty": "iz",
				"infoFiltered": "de",
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