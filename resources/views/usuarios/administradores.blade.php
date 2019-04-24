@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div  id="" class="justify-content-center text-center">
		<h2 class="text-center">Administradores</h2>
		<br>
		<div class="row">
			<!--<administradores-component>
			</administradores-component> -->
		</div>	
			<table id="administradores" class="table table-striped table-bordered" style="width: 100%">
				<thead> 
					<tr>
						<th width="10px">Razon Social</th>
						<th>Email</th>
						<th>Rut</th>
						<th>password</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
			</table>    		

	</div>
</div>
 <script >
 	$(document).ready(function(){
 		if(localStorage.getItem('access_token')){
 			var config = {
 				headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
 			}
 		}
 		else{
 			location.href = 'http://localhost:3000/';
 		}
		$('#administradores').DataTable(
			{
			'paging': true,
			'ordering': true,
			"serverSide": true,
			// "ajax" : "url('')",
			// axios.get('/api/administradores/', config)),	
			 ajax: {
		        url: '/api/administradores',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'razon_social'},
				{data: 'email'},
				{data: 'rut'},
				{data:'password_visible'},
				{data: 'btn'}
			],
			"Languaje":{
				"info":"_TOTAL_registros",
				"search": "Buscar",
				"paginate":{
					"next":"Siguiente",
					"previous":"Anterior",
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
			}
		}
		);
	});
 </script>
@endsection

