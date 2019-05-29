@extends('master')

@section('vue.js')
<div class="container-fluid" id="encuesta_create" >
	<br>

	<div class="justify-content-center text-center">
		<h2 class="text-center">Crear Encuesta</h2>
		<br>	
		<div class="row text-center justify-content-center">
			<div class="col-md-8">
				<form class="needs-validation" novalidate>
				  <div class="form-row">
				    <div class="col-md-4 mb-3">
				      <label for="validationCustom01">Descripcion</label>
				      <input type="text" class="form-control" id="validationCustom01" placeholder="Descripcion" v-model="descripcion" required>
				      <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.descripcion" >@{{ erroresEncuesta.descripcion[0] }}</div>
				  	</div>
				    <div class="col-md-4 mb-3">
					      <label for="validationCustom02">Tipo Encuesta</label>
					     <select   class="form-control" v-on:change="changeTipoEncuesta()" v-model ="select_tipo_encuesta">
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
				  <div class="row justify-content-center" v-if="select_tipo_encuesta == 2">
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
							        <th>fecha_nacimiento</th>							      
							        <th>email</th>							      
							        <th>telefono</th>
							      </tr>
							    </thead>			    
				  			</table>
				  			  <div class="col text-center " v-if="loaderCliente">                
			                <div class="loader"  style="margin: auto;"></div>
			              </div>	
			              <div  v-else>
			              	<button class="btn btn-primary"  @click.stop='postEncuestaCliente()' type="button">Crear</button>			              		
			              	</div>	
				  			
					 	</div>
					</div>
				  	 <div v-if="(select_tipo_encuesta == 1) || (select_tipo_encuesta == 3)" class="row justify-content-center" >
				  	 	<div class="col-md-12">				  	 	
					  	 	<div class="card card-body" style="margin:auto;">
					  	 		<form>
							  		<div class="form-row">							  		
							  			<div class="form-group col-md-4">
									      <label for="inputEmail4">Categoria</label>
									      <input type="text" class="form-control" id="inputEmail4" v-model="categoria.nombre" >
									    </div>
										<div class="card card-body" style="margin:auto;">
											<form>
							  					<div class="form-row">	
												    <div class="form-group col-md-5">
												      <label for="inputPassword4">Marca/Producto</label>
												      <input type="text" class="form-control" id="inputPassword4" placeholder="Quaker / Trencito" v-model="nombre">
												    </div>
												     <div class="form-group col-md-5">
												      <label for="inputPassword4">Tipo Producto</label>
												      <select   class="form-control" v-model ="tipo">
												     	<option v-for="tipo in tipos_productos" :value="tipo.id">@{{ tipo.nombre}}</option>
												     </select>
												    </div>
												    <div class="form-group col-md-2">
												    	<b-button v-b-tooltip.hover class="btn btn-light" title="Agregar Producto" @click.stop="agregarProducto()">
												    		Agregar
												    	</b-button>
												    </div>
												 </div>	
											</form>		
											<div v-for="producto in categoria.productos">
												<form >
								  					<div class="form-row">	
													    <div class="form-group col-md-5">
													      
													      <input type="text" readonly  class="form-control-plaintext"  id="inputPassword4" v-model="producto.nombre" >
													    </div>
													     <div class="form-group col-md-5">
													     	<div v-for="tipo in tipos_productos" v-if="producto.tipo == tipo.id">
													     		<input type="text" readonly  class="form-control-plaintext"  id="inputPassword4" v-model="tipo.nombre" >
													     	</div>	
													    </div>
													 </div>	
												</form>
											</div>									
										</div>								  		
							    	</div>	
								</form>
								<b-button v-b-tooltip.hover class="btn btn-light" title="Agregar Categoria" @click.stop="agregarCategoria()">
						    		Agregar Categoria
						    	</b-button>
					  	 	</div>
					  	 	<br><br>
					  	 	<div class="card card-body" style="margin:auto;" v-for="categoriaT in categorias">
					  	 		<form>
							  		<div class="form-row">							  		
							  			<div class="form-group col-md-4">
							  				<label style="margin: auto;" for=""><b>@{{ categoriaT.nombre }}</b></label>
									    </div>
									    <div class="card card-body" style="margin:auto;" >
									    	<div v-for="prod in categoriaT.productos">
												<form >
								  					<div class="form-row">	
													    <div class="form-group col-md-5">
													      
													      <input type="text" readonly  class="form-control-plaintext"  id="inputPassword4" v-model="prod.nombre" >
													    </div>
													     <div class="form-group col-md-5">
													     	<div v-for="tipo in tipos_productos" v-if="prod.tipo == tipo.id">
													     		<input type="text" readonly  class="form-control-plaintext"  id="inputPassword4" v-model="tipo.nombre" >
													     	</div>	
													    </div>
													 </div>	
												</form>
											</div>	
										</div>						  		
							    	</div>	
								</form>
					  	 	</div>				  	 	
					  	 </div>
					  	   <div class="col text-center " v-if="(loaderExistente == true)">                
			                <div class="loader"  style="margin: auto;"></div>
			              </div>			             
					  	 <button v-if="(select_tipo_encuesta !== 2) && (categorias.length > 0 && (loaderExistente == false))" class="btn btn-primary"  @click.stop='postEncuestaExistente()' type="button">Crear</button>
					 </div> 
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
<meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />

<script type="text/javascript">
  if(history.forward(1)){
    location.replace( history.forward(1) );
  }
</script>
<script>
window.onload = function(){
	if(!localStorage.getItem('access_token'))
 		{
 			location.href = '/';
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
					console.log(resp);
					console.log(resp.rol_id);
					if(resp.rol_id != 1){
						location.href = '/';
					}
					else{
						alertify.set('notifier','position', 'top-right');
						alertify.notify('Recuerde que antes de crear una encuesta se debe subir la data de clientes actualizada al sistema', 'error', 20, function(){  console.log(); });
					}			
				},
				error(error){							
				}
	 		});
 	}


 	
	
</script>

