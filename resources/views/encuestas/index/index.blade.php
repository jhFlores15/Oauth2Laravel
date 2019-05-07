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
		<table id="localidades" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th>ID</th>
					<th>Descripcion</th>
					<th>Estado</th>
					<th>Tipo de Encuesta</th>
					<th>Inicio</th>
					<th>Termino</th>
					<th>Registro</th>
					<th>&nbsp;</th>
				</tr>
			</thead>							
		</table>
	</div>
</div>
 <script >

 	$(document).ready(function(){

 		if(!localStorage.getItem('access_token'))
 		{
 			location.href = 'http://localhost:3000/';
 		}

		var table = $('#localidades').DataTable(
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
				{data: 'created_at'},
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
				"lengthMenu":'Mostrar <select>'+
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
 <style>
 	td.highlight{
 		background-color: whitesmoke !important;
 	}
 </style>
@endsection

