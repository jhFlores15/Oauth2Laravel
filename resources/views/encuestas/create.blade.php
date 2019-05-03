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
				  <div class="row justify-content-center" v-if="select_tipo_encuesta == 2">
				  	<!--<div class="col-md-8">
				  		<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    	<img src="https://img.icons8.com/color/40/000000/import-csv.png">					   
						  </div>
						  <div class="custom-file">
						    <input type="file" id="file" ref="file" class="custom-file-input"  v-on:change="handleFileUpload()"  required accept=".csv" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
						    <label class="custom-file-label" for="inputGroupFile01" >Elegir Archivo CSV</label>
						  </div>						  
						</div>
						<div class="alert alert-danger" role="alert" v-if="erroresEncuesta.csv" >@{{ erroresEncuesta.csv[0] }}</div>
					  </div>-->


						<div class="col-md-8">
					  		<div class="input-group mb-3">
								<div class="input-group-prepend">
								  	<img src="https://img.icons8.com/color/40/000000/ms-excel.png">					   
								</div>
								<b-form-file require accept=".csv,.xlsx"  type="file" id="file" ref="file"  v-on:change="selectedFile($event)" placeholder="Escoge un archivo..." v-model="file"></b-form-file>
							</div>
							<div class="alert alert-danger" role="alert" v-if="erroresEncuesta.csv" >@{{ erroresEncuesta.csv[0] }}</div>
					  </div>	


				  	</div>

				  	 <div v-if="(select_tipo_encuesta == 1 )|| (select_tipo_encuesta == 2)">
				  	 	<!-- Aqui lo que pase con los otros dos tipos de encuesta-->
				  	 </div>
				  	 <div class="row">
				  	 	 <button class="btn btn-primary"  @click.stop='postEncuesta()' type="button">Crear</button>
				  	 </div>	
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
<style type="text/css" media="screen">

	.custom-file-input:lang(en) ~ .custom-file-label::after {
  		content: 'Examinar' !important;
	}
	
</style>
