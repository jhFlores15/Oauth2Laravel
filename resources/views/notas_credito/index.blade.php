@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Notas de Credito</h2>
		<br>
		<table id="notas_credito" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th></th>
					<th>Factura</th>
					<th>Cod_Cliente</th>
					<th>Cliente</th>
					<th>Monto $</th>
					<th>Detalle</th>
					<th>Cantidad</th>
					<th>Descripcion</th>
					<th>Autoriza</th>
					<th>Vendedor</th>
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
					'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
				},
				success:function(resp){						
					if(resp.rol_id != 1){
						window.location.href = '/';
					}
						
				},
				error(error){							
				}
	 		});
 	}
 
 	$(document).ready(function(){
		var table = $('#notas_credito').DataTable(
			{
				 className: 'select-checkbox',
			'processing':true,
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/notas_credito_i/admin',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },	
		    "columnDefs": [ {
		    	className: 'select-checkbox',	           
	            targets:   0,
	        } ],
	        "select": {
	             style: 'multi',
	             blurable: true,
	           
	        },	
			"columns":[		
				{data: 'btn'},
				{data: 'factura'},
				{data: 'cliente_id'},
				{data: 'cliente_name'},
				{data: 'monto'},
				{data: 'detalle'},
				{data: 'cantidad'},
				{data: 'descripcion'},		
				{data: 'autoriza.nombre'},	
				{data: 'user.codigo'},		
			],
			
			dom: 'Bfrtip',
			lengthMenu: [
	            [ -1 ],
	            [ 'Ver Todos' ]
	        ],
	        buttons: [
	            'pageLength',
	            { extend: 'selectAll', text: 'Seleccionar Todos' },
	             { extend: 'selectNone', text: 'Deseleccionar Todos' },
	            {
	                text: 'Exportar Seleccionados',
	                action: function () {
	                    var data = table.rows( { selected: true } ).data().toArray();
					    $.ajax({
							method:"POST",
							url:'/api/notas_credito_i/export',
							data: JSON.stringify(data),
							headers : {
								'Content-Type': 'application/json',
								'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
							},
							success:function(resp){	
								if(resp == 'ok'){
								window.open('/excel/down','_blank');
								}
								else if(resp == 'fail'){
									alertify.set('notifier','position', 'top-right');
		   							alertify.notify('seleccione datos para exportar', 'error', 3, function(){  console.log(); });
								}
							},
							error(error){	
							
							}
						});
	                }
	            },
	            {
	                text: 'Eliminar Seleccionados',
	                 action: function () {
	                    alertify.confirm('Eliminacion', '¿Esta Seguro de Eliminar los Datos Seleccionados?', function(){ 
	                    	 var data = table.rows( { selected: true } ).data().toArray();
	                    	$.ajax({
								method:"POST",
								url:'/api/notas_credito_i/destroy',
								data: JSON.stringify(data),
								headers : {
									'Content-Type': 'application/json',
									'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
								},
								success:function(resp){	
									if(resp == 'ok'){
										alertify.set('notifier','position', 'top-right');
			   							alertify.notify('Eliminados', 'success', 3, function(){  console.log(); });
			   							location.reload(true);
									}
									else if(resp == 'fail'){
										alertify.set('notifier','position', 'top-right');
			   							alertify.notify('seleccione datos para eliminar', 'error', 3, function(){  console.log(); });
									}

								},
								error(error){	
								
								}
							});
		              		
	                   }, function(){ });
	                      }
	            }
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
				
				"loadingRecords": "Cargando...",
				"processing":"Procesando...",
				"emptyTable":"No hay datos...",
				"zeroRecords": "No hay coincidencias",
				"infoEmpty": "iz",
				"infoFiltered": "de",
				"buttons":{
					 copyTitle: 'Copiado al Portapapeles',
					 copySuccess: {
	                    _: '%d lineas copiadas',
	                    1: '1 linea copiada'
	                }
				},

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

