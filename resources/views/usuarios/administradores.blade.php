@extends('master')

@section('DataTable')
<div class="container-fluid" >
	<br>
	<div  id="" class="justify-content-center text-center">
		<h2 class="text-center">Administradores</h2>
		<br>
		<div class="row">
			<!--<administradores-component>
			</administradores-component> -->
		</div>	
		<div class="row">
			<table id="administradores" class="table table-striped table-bordered" style="width: 100%">
				<thead> 
					<tr>
						<th width="10px">Razon Social</th>
						<th>Email</th>
						<th>Rut</th>
						<th>password</th>
						<th>$&nbsp;</th>
					</tr>
				</thead>
				
			</table>
		</div>	    		

	</div>
</div>
 <script >
 	$(document).ready(function(){
		$('#administradores').DataTable({
			paging: true,
			ordering: true,
			"serverSide": true,
			axios.get('/api/administradores/', config).
		        then(response => {
		          	this.users= response.data;
	        }).catch(error => {
	          console.log(error)
	        }); 

			}),
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
	});
 </script>
@endsection

