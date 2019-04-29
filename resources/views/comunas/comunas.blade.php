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
			  	<button type="button" onclick="guardarComuna()" class="btn btn-primary mb-2">Guardar</button>
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
 	window.onload = function(){
 		combobox();
 	};

 	function guardarComuna(){
		var comuna = document.getElementById('comunaNew').value;
		var region_id  = $('#combobox option:selected').val();
		ajaxNew(comuna,region_id);
 	}

 	function ajaxNew(comuna,region_id){
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
				console.log(resp);
				if(resp == 'ok'){
					alert('Comuna Creada');
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
				alert('Comunas no Encontrada');
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

