@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Mis Notas de Credito</h2>
		<br>
		<a type="button" href="/notas_credito/create" class="btn btn-outline-primary">Registrar Nuevo</a>
		<table id="notas_credito" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
			<thead> 
				<tr>
					<th>Factura</th>
					<th>&nbsp;</th>
					<th>Cod_Cliente</th>
					<th>Cliente</th>
					<th>Monto $</th>
					<th>Detalle</th>
					<th>Cantidad</th>
					<th>Descripcion</th>
					<th>Autoriza</th>
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
					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
				},
				success:function(resp){						
					if(resp.rol_id != 2){
						window.location.href = '/';
					}
						
				},
				error(error){							
				}
	 		});
 	}
 
 	$(document).ready(function(){
 		jQuery.extend( jQuery.fn.dataTableExt.oSort, {
		    "formatted-num-pre": function ( a ) {
		        a = (a === "-" || a === "") ? 0 : a.replace( /[^\d\-\.]/g, "" );
		        return parseFloat( a );
		    },
		 
		    "formatted-num-asc": function ( a, b ) {
		        return a - b;
		    },
		 
		    "formatted-num-desc": function ( a, b ) {
		        return b - a;
		    }
		} );

		var table = $('#notas_credito').DataTable(
			{
			'processing':true,
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/notas_credito_i/vendedor',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },	
		     
			"columns":[			
				{data: 'factura'},
				{data: 'btn'},
				{data: 'cliente_id'},
				{data: 'cliente_name'},
				{data: 'monto',  render: $.fn.dataTable.render.number( ',', '.', 0, '$' )},
				{data: 'detalle'},
				{data: 'cantidad'},
				{data: 'descripcion'},				
				{data: 'autoriza.nombre'},	
			],

			dom: 'Bfrtip',
			lengthMenu: [
	            [ -1 ],
	            [ 'Show all' ]
	        ],
	        buttons: [
	            'pageLength',
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

