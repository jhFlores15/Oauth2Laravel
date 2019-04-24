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
			<table id="administradores" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
				<thead> 
					<tr>
						<th>Razon Social</th>
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

 		if(!localStorage.getItem('access_token'))
 		{
 			location.href = 'http://localhost:3000/';
 		}

		var table = $('#administradores').DataTable(
			{
			'paging': true,
			"serverSide": true,
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
								'<option value="2">2</option>'+
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
			'dom': 'Bfrtip',
			'buttons':[
				'copy','excel','pdf'
			],
		});

		// new $.fn.dataTable.Buttons(table,{
		// 	buttons:[
		// 		'copy','excel','pdf'
		// 	],
		// })
		table.buttons().container().appendTo($('.col-sm-sm-6:eq(0)',table.table().container()));

		// $('#administradores tbody')
		// .on('mouseenter','td', function(){
		// 	var colIdx = table.cell(this).index().column;
		// 	$(table.cells().nodes()).removeClass('highlight');		
		// 	$(table.column(colIdx).nodes()).addClass('highlight');
		// });
		

		

		
	});
 </script>
 <style>
 	td.highlight{
 		background-color: whitesmoke !important;
 	}
 </style>
@endsection

