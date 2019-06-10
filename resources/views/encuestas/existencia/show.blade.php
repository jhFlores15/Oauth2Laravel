@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Encuesta Existencia</h2> <br><br>
		<ul class="nav justify-content-end" style="width: 60%;  margin:auto;">			  
		  	@if($encuesta->estado == "En Proceso")
			  	<li class="nav-item">
			  		<div id="buttonTerminar" >
			  			<button type="button" class="btn btn-outline-danger" onclick="terminar()" href="#">Finalizar Encuesta</button>
			  		</div>			  		
			  	</li>
		  	@endif
		 
		  	@if($encuesta->estado == "Inactivo" || $encuesta->estado == "Finalizado")
		  		<li class="nav-item">
		  			<div id="buttonIniciar">
		  				<button type="button"  onclick="iniciar()" class="btn btn-outline-success">
		  				Iniciar Encuesta
		  			</button>
		  			</div>		  			
		  		</li>		  		
		  	@endif	
		  	@if($encuesta->editableEliminable)
		  		<li class="nav-item">
		  			<a type="button" href="/encuestas/{{ $encuesta->id }}/edit/" class="btn btn-outline-primary">Editar</a>
		  		</li>
		  		 <button type="button" onclick="modalEliminar()" class="btn btn-outline-danger">
					Eliminar
				</button>	
			    	
			 @endif	  

		</ul>
		<div class="card card-body" style="width: 80%;  margin:auto;">
		    <form>
			  <div class="form-row align-items-start">
			    <div class="form-group col">
			      <label for="inputEmail4">Descripcion</label>
			      <div class="card card-body text-center" >
			      	<label for="">{{ $encuesta->descripcion}}</label>
			      </div>
			     
			    </div>
			    <div class="form-group col">
			      <label for="inputPassword4">Estado</label>
			     	<div class="card card-body text-center" >
			      	<label style="color: red;" for=""><b><h5>{{ $encuesta->estado}}</h5></b></label>
			      </div>
			    </div>
			    <div class="form-group col">
			      <label for="inputPassword4">Fecha de Inicio</label>
			     	<div class="card card-body text-center" >
			      	<label for="">{{ $encuesta->inicio}}</label>
			      </div>
			    </div>
			    @if($encuesta->estado == "Finalizado")
				    <div class="form-group col">
				    	<label for="inputPassword4">Fecha de Termino</label>
				     	<div class="card card-body text-center" >
				      		<label for="">{{ $encuesta->termino}}</label>
				      </div>
				  	</div>
				  	<div class="form-group col">
				     	<label style="visibility: hidden;" for="inputPassword4"></label>
				     	<div class="card card-body text-center" >
				      		<label  style=" margin:auto;" class="text-center"><h6><b>{{ $encuesta->registros }} Encuestado(s) de un Total de {{ $encuesta->total }} que debian ser Encuestados</b></h6></label>	
				      	</div>						
				     </div>
			    @endif
			    @if($encuesta->estado == "En Proceso")
					<div class="form-group col">
				     	<label style="visibility: hidden;" for="inputPassword4"></label>
				     	<div class="card card-body text-center" >
				      		<label  style=" margin:auto;" class="text-center"><h6><b>{{ $encuesta->registros }} Encuestado(s) de un Total de {{ $encuesta->total }} a Encuestar</b></h6></label>	
				      	</div>						
				     </div>
			    @endif	 
			  </div>
			</form>
		 </div>
		 <br>
		<nav>
			<div id="loaderExcel">
				
			</div>
		  <div class="nav nav-tabs justify-content-end" id="nav-tab" role="tablist" style="width: 80%;  margin:auto;">
		    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Clientes Encuestados</a>
		    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Clientes No Encuestados</a>
		  </div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
		  	<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		 
					<table id="clientes" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
						<thead> 						
						  	<tr>
						  		<th colspan="5">Datos Cliente</th>
							  	@foreach ($categorias as $categoria)
							  		 <th colspan="{{ $categoria->count() }}">{{ $categoria[0]->categoria->nombre }}</th>
							  	@endforeach	
							  	<th rowspan="2">&nbsp;</th>			               
			            	</tr>
							<tr>
								<th>Codigo</th>
								<th>Rut</th>
								<th>dv</th>
								<th>Comuna</th>
								<th>Vendedor</th>	
								@foreach ($categorias as $categoria)
									@foreach ($categoria as $prod)
								    	<th>{{ $prod->nombre }}</th>
								    @endforeach
								@endforeach	
							</tr>
						</thead>							
					</table>  
			
		  	</div>
		  	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				
		</nav>
					<table id="noEncuestados" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
						<thead> 							
							<tr>
								<th>Codigo</th>
								<th>Razon Social</th>
								<th>Rut</th>
								<th>dv</th>
								<th>Vendedor</th>
								<th>Direccion</th>
								<th>Comuna</th>
							</tr>
						</thead>							
					</table>  
			
			</div>
		</div>
<!-- ////////////////////Modal Eliminar////////////////////////////-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Encuesta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">
      		<div class="row text-center">
      		<h5>¿Esta Seguro de Eliminar Esta Encuesta?</h5>
	      	</div>
	      	<div class="row text-center">
	      		<form>	   
	      			<div class="form-group row">
					    <label for="staticEmail" class="col-md-4 col-form-label">Descripcion</label>
					    <div class="col-md-8">
					     	<input type="text" readonly class="form-control-plaintext" id="descripcionDelete" value="{{ $encuesta->descripcion }}">
					    </div>
				 	 </div>
				  	<div class="form-group row">
				    	<label for="staticEmail" class="col-md-4 col-form-label">Fecha Inicio</label>
				    	<div class="col-md-8">
				      		<input type="date" readonly class="form-control-plaintext" id="fechaDelete" value="{{ $encuesta->inicio }}">
				   		 </div>
				 	</div>
				</form>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <div id="okDelete">
        	<button type="button"  onclick="eliminarEncuestaEP()" class="btn btn-primary">Si</button>	
        </div>       		
      </div>
    </div>
  </div>
</div>

<script>
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
					if(resp.rol_id != 1){
						window.location.href = '/';
					}
						
				},
				error(error){							
				}
	 		});
 	}


	function modalEliminar(){
		$('#deleteModal').modal('show');
	}
	function eliminarEncuestaEP(){ // este tipo de encuesta
		$('#okDelete').html('<div class="loader"></div>');
		$.ajax({
			method:"DELETE",
			url:'/api/encuestas/{{ $encuesta->id }}',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
			},
			success:function(resp){
			$('#okDelete').html('<button type="button" onclick="eliminarEncuestaEP()" class="btn btn-primary">Si</button>');	
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
	   				alertify.notify('Encuesta Eliminada', 'success', 3, function(){  console.log(); });
					location.href="/encuestas";
				}
			},
			error(error){
				$('#okDelete').html('<button type="button" onclick="eliminarEncuestaEP()" class="btn btn-primary">Si</button>');
				alertify.set('notifier','position', 'top-right');
	   			alertify.notify('Encuesta no puede ser Eliminada, constituye perdida de Datos', 'error', 6, function(){  console.log(); });
				$('#deleteModal').modal('hide');
			}
		});
		
	}
	
 	$('#example').tooltip({ boundary: 'window' })
 
 	function iniciar(){
 		$('#buttonIniciar').html('<div class="loader"></div>');
 		$.ajax({
			method:"PUT",
			url:'/api/encuesta/clientes/iniciar/{{ $encuesta->id }}',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
			},
			success:function(resp){	
				$('buttonIniciar').html('<button type="button" onclick="iniciar()" class="btn btn-outline-success">Iniciar Encuesta</button>');
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
	   				alertify.notify('Encuesta Iniciada', 'success', 3, function(){  console.log(); });
					location.reload(true);
				}
			},
			error(error){
				$('buttonIniciar').html('<button type="button" onclick="iniciar()" class="btn btn-outline-success">Iniciar Encuesta</button>');
				alertify.set('notifier','position', 'top-right');
	   			alertify.notify('Error', 'error', 3, function(){  console.log(); });
			}
		});
		

 	}
 	function terminar(){
 		$('#buttonTerminar').html('<div class="loader"></div>');
		$.ajax({
			method:"PUT",
			url:'/api/encuesta/clientes/terminar/{{ $encuesta->id }}',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
			},
			success:function(resp){	
				$('#buttonTerminar').html('<button type="button" class="btn btn-outline-danger" onclick="terminar()" href="#">Finalizar Encuesta</button>');
				console.log(resp);
				if(resp == 'ok'){
					alertify.set('notifier','position', 'top-right');
	   				alertify.notify('Encuesta Finalizada', 'success', 3, function(){  console.log(); });
					location.reload(true);
				}
			},
			error(error){
				$('#buttonTerminar').html('<button type="button" class="btn btn-outline-danger" onclick="terminar()" href="#">Finalizar Encuesta</button>');
				alertify.set('notifier','position', 'top-right');
	   			alertify.notify('Error', 'error', 3, function(){  console.log(); });
			}
		});
		
 	}

 	$(document).ready(function(){
 		var data = "";
		var table = $('#clientes').DataTable(
			{
			"processing":true,
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/encuestas/existencia/Admin/Y/{{ $encuesta->id }}',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				}, 				
		    },		
			"columns":[
				{data: 'codigo'},
				{data: 'rut'},
				{data: 'dv'},
				{data:'comuna.nombre'},
				{data:'vendedor.codigo'},
				
			
			@for ($i = 0; $i < $encuesta->marcasCount; $i++)
				 {data: 'valores.{{ $i }}.valor'},
			@endfor	
			],
			dom: 'Bfrtip',
			lengthMenu: [
	            [ 10, -1 ],
	            [ '10 rows', 'Show all' ]
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
		table.button().add( 0, {
				action: function ( e, dt, button, config ) {
					$('#loaderExcel').html('<div class="loader"></div>')
					$.ajax({
						method:"GET",
						url:'/api/encuestas/existencia/Admin/export/{{ $encuesta->id }}',
						headers : {
							'Content-Type': 'application/json',
							'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
						},
						success:function(resp){
							$('#loaderExcel').html('')
							if(resp == 'ok'){
								window.open('/excel/down','_blank');
							}
							else if(resp == 'fail'){
								alertify.set('notifier','position', 'top-right');
	   							alertify.notify('No hay datos que exportar', 'error', 3, function(){  console.log(); });
							}
						},
						error(error){
						$('#loaderExcel').html('')						
						}
					});
				},
				text: 'Excel'
			} );	

		

	
        
		var table = $('#noEncuestados').DataTable(
			{
			"processing":true,
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/encuestas/existencia/Admin/N/{{ $encuesta->id }}',
		        headers : {
 					'Content-Type': 'application/json',
 					'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
 				},
		    },		
			"columns":[				
				{data: 'codigo'},
				{data: 'razon_social'},
				{data: 'rut'},
				{data: 'dv'},
				{data:'vendedor'},
				{data:'direccion'},
				{data:'comuna'},			
			],
			dom: 'Bfrtip',
			lengthMenu: [
	            [ 10, -1 ],
	            [ '10 rows', 'Show all' ]
	        ],       
	         buttons: [ ,
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
		table.button().add( 0, {
				action: function ( e, dt, button, config ) {
					$('#loaderExcel').html('<div class="loader text-center">')
					$.ajax({
						method:"GET",
						url:'/api/encuestas/existencia/Admin/N/{{ $encuesta->id }}/export',
						headers : {
							'Content-Type': 'application/json',
							'Authorization': 'Bearer '+ localStorage.getItem('access_token'),
						},
						success:function(resp){
							$('#loaderExcel').html('')
							if(resp == 'ok'){
								window.open('/excel/down','_blank');
							}
							else if(resp == 'fail'){
								alertify.set('notifier','position', 'top-right');
	   							alertify.notify('No hay datos que exportar', 'error', 3, function(){  console.log(); });
							}
						},
						error(error){	
							$('#loaderExcel').html('')					
						}
					});
				},
				text: 'Excel'
			} );
	});		
		


 </script>
 <style>
 	td.highlight{
 		background-color: whitesmoke !important;
 	}
 </style>
@endsection

