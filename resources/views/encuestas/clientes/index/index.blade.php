@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>

	<div class="justify-content-center text-center">
		@if($encuesta->tipo_encuesta_id == 2)
			<h2 class="text-center">Encuesta Cliente</h2>
		@endif	
		<br>			
		<table id="clientes" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th>Razon Social</th>
					<th>Direccion</th>
					<th>&nbsp;</th>
					<th>Comuna</th>
					
				</tr>
			</thead>							
		</table>
	</div>
</div>
 <script >
 	window.onload = function(){
 		console.log("montando clientes");
 		ajaxGetClientes();
 	};

 	function ajaxGetClientes(){
 		$.ajax({
			method:"GET",
			url:'/api/encuestas/cliente/'+{{ $encuesta->id }},
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){
				console.log(resp.data);					
			},
			error(error){				
				// alert('Comunas no Encontradas');
				// $('#deleteModal').modal('hide');				
			}
		});
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
		        url:'/api/encuestas/cliente/'+{{ $encuesta->id }},
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'razon_social'},
				{data: 'direccion'},
				{data: 'btn'},
				{data: 'comuna.nombre'},
				
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
				"emptyTable":"No tiene Clientes para Encuestar...",
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

