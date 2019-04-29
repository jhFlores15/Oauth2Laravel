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
			  	<button type="button" onclick="guardarRegion()" class="btn btn-primary mb-2">Guardar</button>
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
				console.log(resp);
				if(resp == 'ok'){
					alert('Region Creada');
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
		$('#errorNombreNew').html('<div></div>');
		
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
			// 'dom': 'Bfrtip',
			// 'buttons':[
			// 	'copy','excel','pdf'
			// ],
		});

		//table.buttons().container().appendTo($('.col-sm-sm-6:eq(0)',table.table().container()));

	
		
	});

		
 </script>
 <style>
 	td.highlight{
 		background-color: whitesmoke !important;
 	}
 </style>
@endsection

