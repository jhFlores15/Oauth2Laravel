@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>

	<div class="justify-content-center text-center">
		@if($encuesta->tipo_encuesta_id == 1)
			<h2 class="text-center">Encuesta Existencia</h2>
		@endif
		@if($encuesta->tipo_encuesta_id == 3)
			<h2 class="text-center">Encuesta Precio</h2>
		@endif	
		<br>			
		<nav>
		  <div class="nav nav-tabs justify-content-end" id="nav-tab" role="tablist" style="width: 80%;  margin:auto;">
		  	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">No Encuestados</a>	
		  	<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Encuestados</a>		    	   
		  </div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		  		<div class="card card-body" style="width: 90%;  margin:auto;">
				<table id="noEncuestados" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
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
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<div class="card card-body" style="width: 90%;  margin:auto;">
					<table id="encuestados" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
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
		</div>
	</div>
</div>
<script >	
 	$(document).ready(function(){

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
						if(resp.rol_id != 2){
							location.href = '/';
						}			
					},
					error(error){							
					}
		 		});
	 	}
		var table = $('#noEncuestados').DataTable(
			{
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/encuestas/existencia/N/{{ $encuesta->id }}',
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
				"emptyTable":"No hay Datos...",
				"zeroRecords": "No hay coincidencias",
				"infoEmpty": "iz",
				"infoFiltered": "de",
			},
			"pagingType": "full_numbers",
		});	

		var table = $('#encuestados').DataTable(
			{
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/encuestas/existencia/Y/{{ $encuesta->id }}',
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
				"emptyTable":"No hay Encuestados Aun...",
				"zeroRecords": "No hay coincidencias",
				"infoEmpty": "iz",
				"infoFiltered": "de",
			},
			"pagingType": "full_numbers",
		});	
		
	});		
 </script>
 @endsection