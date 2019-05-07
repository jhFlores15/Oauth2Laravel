@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>

	<div class="justify-content-center text-center">
		<h2 class="text-center">Encuesta Cliente</h2> <br><br>
		<ul class="nav justify-content-end" style="width: 60%;  margin:auto;">		  
		  	@if($encuesta->estado == "En Proceso")
			  	<li class="nav-item">
			  		<a type="button" class="btn btn-danger" href="#">Finalizar Encuesta</a>
			  	</li>
		  	@endif
		  	@if($encuesta->estado == "Inactivo")
		  		<li class="nav-item">
			  		<a type="button" class=" btn btn-outline-primary " href="#">Editar Encuesta</a>
			  	</li>
		  	@endif
		  	@if($encuesta->estado == "Inactivo" || $encuesta->estado == "Finalizado")
		  		<li class="nav-item">
		  			<button type="button" class="btn btn-outline-success">
		  				Iniciar Encuesta
		  			</button>
		  			{{-- <a type="button" class="nav-link active btn btn-success" href="#">Iniciar Encuesta</a> --}}
		  		</li>
		  		<li class="nav-item">
		  			<button type="button" id="example" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Exportar a  Excel">
		  				<img src="https://png.icons8.com/color/22/000000/ms-excel.png">
		  			</button>
		  			{{-- <a type="button" class="nav-link active btn btn-success" href="#">Exportar a Excel</a> --}}
		  		</li>
		  	@endif

		</ul>
		<div class="card card-body" style="width: 60%;  margin:auto;">
		    <form>
			  <div class="form-row">
			    <div class="form-group col-md-4">
			      <label for="inputEmail4">Descripcion</label>
			      <div class="card card-body text-center" >
			      	<label for="">{{ $encuesta->descripcion}}</label>
			      </div>
			     
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputPassword4">Estado</label>
			     	<div class="card card-body text-center" >
			      	<label for="">{{ $encuesta->estado}}</label>
			      </div>
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputPassword4">Fecha de Inicio</label>
			     	<div class="card card-body text-center" >
			      	<label for="">{{ $encuesta->inicio}}</label>
			      </div>
			    </div>
			  </div>
			</form>
		 </div>
		 <br>
		<div class="card card-body" style="width: 90%;  margin:auto;">
			<table id="clientes" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
				<thead> 
					<tr>
						<th>Codigo</th>
						<th>Razon Social</th>
						{{-- <th>Rut</th>
						<th>dv</th> --}}
						<th>Vendedor</th>
						{{-- <th>Direccion</th> --}}
						<th>Localidad</th>						
						<th>Registro</th>
						<th>&nbsp;</th>
					</tr>
				</thead>							
			</table>  
		</div>


		
	</div>
</div>
 <script >
 	$('#example').tooltip({ boundary: 'window' })
 // 	window.onload = function(){
 // 		console.log("montando clientes");
 // 		ajaxGetClientes();
 // 	};

 // 	function ajaxGetClientes(){
 // 		$.ajax({
	// 		method:"GET",
	// 		url:'/api/encuestas/cliente/'+{{ $encuesta[0]['id'] }},
	// 		headers : {
	// 			'Content-Type': 'application/json',
	// 			'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
	// 		},
	// 		success:function(resp){
	// 			console.log(resp.data);					
	// 		},
	// 		error(error){				
	// 			// alert('Comunas no Encontradas');
	// 			// $('#deleteModal').modal('hide');				
	// 		}
	// 	});
 // 	}

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
		        url: '/api/encuesta/clientes/{{ $encuesta->id }}',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[
				{data: 'codigo'},
				{data: 'razon_social'},
				// {data: 'rut'},
				// {data: 'dv'},
				{data:'vendedor.codigo'},
				// {data:'direccion'},
				{data:'localidad.nombre'},
				{data:'created_at'},
				{data: 'btn'},
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
				"lengthMenu":'Mostrar <select class="form-control">'+
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
		});	
		
	});		
 </script>
 <style>
 	td.highlight{
 		background-color: whitesmoke !important;
 	}
 </style>
@endsection

