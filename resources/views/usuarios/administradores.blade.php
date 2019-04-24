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

			
			// "columnDefs": conbinacion de celdas
			// [
			// 	{
			// 		"render" : function (data,type,row){
			// 			return data + '(' + row[3] + ')';
			// 		},
			// 		"targets": 0
			// 	},
			// 	{ "visible" : false, "targets" : [3]}
			// ]
		});

		$('#administradores tbody')
		.on('mouseenter','td', function(){
			var colIdx = table.cell($this).index().column;

			$(table.cells()).removeClass('highlight');
			$(table.column(colIdx).nodes()).addClass('highlight');
		});

		// $("#administradores tfoot th").each(function(){
		// 	var title = $(this).text();
		// 	$(this).html('<input type="text" placeholder="Buscar '+title+'"/>')
		// });

		// table.columns().every(function(){
		// 	var that = this;
		// 	$('input',this.footer()).on('keydown',function(ev){
		// 		if (ev.keyCode == 13){
		// 			that.search(this.value)
		// 				.draw();
		// 		}
		// 	});
		// });

		// $('#razon').on('keyup', function(){
		// 	$('#administradores')
		// 		.DataTable()
		// 		.search($('#razon').val(),false,true)
		// 		.draw();
		// });

	});
 </script>
 <style>
 	tfoot input {
 		width: 100%;
 		padding: 3px;
 		box-sizing: border-box;
 		
 	}
 </style>
@endsection

