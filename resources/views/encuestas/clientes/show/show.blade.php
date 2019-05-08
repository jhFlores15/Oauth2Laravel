@extends('master')

@section('dataTable')
<div class="container-fluid" >
	<br>

	<div class="justify-content-center text-center">
		<h2 class="text-center">Encuesta Cliente</h2> <br><br>
		<ul class="nav justify-content-end" style="width: 60%;  margin:auto;">
			<li class="nav-item">
		  		<button type="button" class="btn btn-outline-success" onclick="showModalDatos()" href="#">Subir Clientes Nuevamente</button>
		  	</li>		  
		  	@if($encuesta->estado == "En Proceso")
			  	<li class="nav-item">
			  		<button type="button" class="btn btn-danger" onclick="terminar()" href="#">Finalizar Encuesta</button>
			  	</li>
		  	@endif
		  	@if($encuesta->estado == "Inactivo")
		  		<li class="nav-item">
			  		<a type="button" class=" btn btn-outline-primary " href="#">Editar Encuesta</a>
			  	</li>
		  	@endif
		  	@if($encuesta->estado == "Inactivo" || $encuesta->estado == "Finalizado")
		  		<li class="nav-item">
		  			<button type="button" onclick="iniciar()" class="btn btn-outline-success">
		  				Iniciar Encuesta
		  			</button>
		  		</li>		  		
		  	@endif
		  	{{-- @if($encuesta->estado == "Finalizado")
				<li class="nav-item">
		  			<button type="button" id="example" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Exportar a  Excel">
		  				<img src="https://png.icons8.com/color/22/000000/ms-excel.png">
		  			</button>
	  			</li>
		  	@endif --}}
		  

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
			      	<label for="">{{ $encuesta->estado}}</label>
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
		  <div class="nav nav-tabs justify-content-end" id="nav-tab" role="tablist" style="width: 80%;  margin:auto;">
		    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Clientes Encuestados</a>
		    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Clientes No Encuestados</a>
		  </div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
		  	<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
		  		<div class="card card-body" style="width: 90%;  margin:auto;">
					<table id="clientes" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
						<thead> 
							<tr>
								<th>Codigo</th>
								<th>Razon Social</th>
								{{-- <th>Rut</th>
								<th>dv</th> --}}
								<th>Vendedor</th>
								<th>Cumpleaños</th>
								<th>Telefono</th>
								<th>Email</th>
								<th>Localidad</th>
								<th>&nbsp;</th>
							</tr>
						</thead>							
					</table>  
				</div>
		  	</div>
		  	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<div class="card card-body" style="width: 90%;  margin:auto;">
					<table id="clientess" class="table table-striped dt-responsive table-bordered row-border hover order-column" style="width: 100%">
						<thead> 
							<tr>
								<th>Codigo</th>
								<th>Razon Social</th>
								<th>Rut</th>
								<th>dv</th>
								<th>Vendedor</th>
								<th>Direccion</th>
								<th>Localidad</th>
								<th>&nbsp;</th>
							</tr>
						</thead>							
					</table>  
				</div>
			</div>
		</div>

		<!-- //////////////////////////////////Modal Subir Datos//////////////////////////-->
<div class="modal fade" id="subirDatos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Subir Clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      	<div class="container-fluid text-center">      		
	      	<div class="row text-center">
	      		<h6>Utilizar esto solo en caso que no se hallan subido correctamente los clientes en la creacion de la Encuesta</h6>
				<div id="errorFile"></div>
				<form class="form-inline">
					<div class="form-group">
						<div class="input-group mb-3">
						  	<div class="input-group-prepend">
					    		<img src="https://img.icons8.com/color/40/000000/ms-excel.png">						   
						  	</div>
						  	<div class="custom-file">
						    	<input type="file" id="file" ref="file" class="custom-file-input" name="csv" v-on:change="handleFileUpload()"  required accept=".csv,.xlsx" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
						    	<label class="custom-file-label" data-browse="Examinar" for="inputGroupFile01" >Archivo XLSX &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
						  	</div>
					  	  	<div class="input-group-prepend">
					    		 <button type="button" class="btn btn-outline-success mb-2">Subir Datos</button>
					    	</div>					  
						</div>
						
					</div>
				</form>
				<div class="col-md-7">
					<table class="table table-bordered table-sm">
				    <thead>
				      <tr>
				        <th>codigo</th>
				      </tr>
				    </thead>			    
				  </table>
				</div>
	      	</div>      		
      	</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="okEditar" onclick="postDatos()" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- //////////////////////////////////////////////////////////////////////////////////-->



		<!-- //////////////////////////////////Modal Editar//////////////////////////-->
		{{-- <div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Editar Encuesta</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body text-center">
		      	<div class="container-fluid text-center">      		
			      	<div class="row text-center">
			      		<form class="needs-validation" novalidate>
						  <div class="form-row">
						    <div class="col-md-4 mb-3">
						      <label for="validationCustom01">Descripcion</label>
						      <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" required>
						      <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.descripcion" >@{{ erroresEncuesta.descripcion[0] }}</div>
						  	</div>
						    <div class="col-md-4 mb-3">
							      <label for="validationCustom02">Tipo Encuesta</label>
							     <select   class="form-control" v-model ="select_tipo_encuesta">
							     	<option v-for="tipo in tipos_encuesta" :value="tipo.id">@{{ tipo.nombre}}</option>
							     </select>
							     <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.tipos_encuesta" >@{{ erroresEncuesta.tipos_encuesta[0] }}</div>
							  </div>		
						    <div class="col-md-4 mb-3">
						      <label for="validationCustomUsername" >Fecha de Inicio</label>
						      <div class="input-group">				      
						        <input type="date" class="form-control" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="validationCustomUsername" placeholder=""  required v-model="fecha_inicio">				        	
						      </div>
						      <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.fecha_inicio" >@{{ erroresEncuesta.fecha_inicio[0] }}</div>
						    </div>
						  </div>				 
							<div class="col-md-8">
						  		<div class="input-group mb-3">
									<div class="input-group-prepend">
									  	<img src="https://img.icons8.com/color/40/000000/ms-excel.png">					   
									</div>
									<b-form-file require accept=".csv,.xlsx"  type="file" id="file" ref="file"  v-on:change="selectedFile($event)" placeholder="Escoge un archivo..." v-model="file"></b-form-file>
								</div>							
								<div class="alert alert-danger" role="alert" v-if="erroresEncuesta.csv" >@{{ erroresEncuesta.csv[0] }}</div>
								<table class="table table-bordered table-sm text-center">
								    <thead>
								      <tr>
								        <th>codigo</th>
								      </tr>
								    </thead>			    
					  			</table>
						 	 </div>	
						  	 <div class="row">
						  	 	 <button class="btn btn-primary"  onclick="postEncuestaCliente()" type="button">Editar</button>
						  	 </div>	
						</form>


						<form>	   
			      			<div class="form-group row">
							    <label for="staticEmail" class="col-md-4 col-form-label">Comuna</label>
							    <div class="col-md-8">
							     	<input type="text" class="form-control"  id="comunaEdit" placeholder="Comuna">
							     	 <div id="errorComuna"></div>
							    </div>

						 	 </div>
						  	<div class="form-group row">
						    	<label for="staticEmail" class="col-md-4 col-form-label">Region</label>		
						    	<div class="col-md-8">
						    		<div id="comboboxEdit">
					  				</div>	
						   		 </div>
						 	</div>
						</form>
			      	</div>      		
		      	</div>        
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="button" id="okEditar" onclick="editarComuna()" class="btn btn-primary">Guardar</button>
		      </div>
		    </div>
		  </div> 
		</div>--}}
	</div>
 <script >
 	$('#example').tooltip({ boundary: 'window' })
 	$(".custom-file-input").on("change", function() {
		  var fileName = $(this).val().split("\\").pop();
		  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
 	function showModalDatos(){
 		$('#errorFile').html('<div></div>');
 		$('#subirDatos').modal('show');
 	}
	function postDatos(){
		var file = $('#file')[0].files[0];
		console.log(file);
		let formData = new FormData();            
        formData.append('csv', file);
		console.log(formData);
		$.ajax({
			method:"POST",
			url:'/api//encuestas/clientes/{{ $encuesta->id }}',
			data: formData,
			processData: false,
			contentType: false,
			headers : {
				// 'Content-Type': 'multipart/form-data',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('Datos Actualizados correctamente');
					location.reload(true);
				}
			},
			error(error){
				if(error.status == 422){
					var errores = error.responseJSON.error;
					$('#errorFile').html('<div></div>');
			 		console.log("error");		
					if(errores.file){
						$('#errorFile').html(
							'<div class="alert alert-danger" role="alert">'+
							errores.file[0]+
							'</div>'
							);
					}	
				}
				else{
					alert('ah Ocurrido un error, los datos no se han actualizado Correctamente');
					console.log(error.responseJSON);
				}
			}
		});
	}

 	function iniciar(){
 		$.ajax({
			method:"PUT",
			url:'/api/encuesta/clientes/iniciar/{{ $encuesta->id }}',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('ok');
					location.reload(true);
				}
			},
			error(error){
				alert('ah ocurrido un error');
			}
		});

 	}
 	function terminar(){
		$.ajax({
			method:"PUT",
			url:'/api/encuesta/clientes/terminar/{{ $encuesta->id }}',
			headers : {
				'Content-Type': 'application/json',
				'Authorization': localStorage.getItem('token_type')+ ' ' + localStorage.getItem('access_token'),
			},
			success:function(resp){	
				console.log(resp);
				if(resp == 'ok'){
					alert('ok');
					location.reload(true);
				}
			},
			error(error){
				alert('ah ocurrido un error');
			}
		});
 	}

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
				{data:'cumpleaños'},
				{data:'telefono'},
				{data:'email'},
				// {data:'direccion'},
				{data:'localidad.nombre'},
				{data: 'btn'},
			],
			dom: 'Bfrtip',
	        buttons: [
	            'copy',
	            {
	            	extend: 'excel',
	            	title:'Clientes Encuestados',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'pdf',
	            	title:'Clientes Encuestados',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'print',
	            	title:'Clientes Encuestados',
	            	exportOptions: {
	                    columns: ':visible'
	                },autoFilter: true,
	            }, 
	            {
	            	extend: 'colvis',
	            	text: 'Seleccionar Columnas',
	            	collectionLayout: 'fixed two-column',
	            },
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
		var table = $('#clientess').DataTable(
			{
			'paging': true,
			"serverSide": true,
			 ajax: {
		        url: '/api/encuesta/clientes/No/{{ $encuesta->id }}',
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
				{data:'vendedor.codigo'},
				{data:'direccion'},
				{data:'localidad.nombre'},
				{data: 'btn'},
			],
			dom: 'Bfrtip',
	        buttons: [
	            'copy',
	            {
	            	extend: 'excel',
	            	title:'Clientes No Encuestados',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'pdf',
	            	title:'Clientes No Encuestados',
	            	exportOptions: {
	                    columns: ':visible'
	                },
	                autoFilter: true,
	            },
	            {
	            	extend: 'print',
	            	title:'Clientes No Encuestados',
	            	exportOptions: {
	                    columns: ':visible'
	                },autoFilter: true,
	            }, 
	            {
	            	extend: 'colvis',
	            	text: 'Seleccionar Columnas',
	            	collectionLayout: 'fixed two-column',
	            },
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

