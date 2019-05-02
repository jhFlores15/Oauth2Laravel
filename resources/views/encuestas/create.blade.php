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
				      <input type="text" class="form-control" id="validationCustom01" placeholder="Descripcion" value="" required>
				  </div>
				    <div class="col-md-4 mb-3">
					      <label for="validationCustom02">Tipo Encuesta</label>
					     <select   class="form-control" v-model ="select_tipo_encuesta">
					     	<option v-for="tipo in tipos_encuesta" :value="tipo.id">@{{ tipo.nombre}}</option>
					     </select>
					  </div>		
				    <div class="col-md-4 mb-3">
				      <label for="validationCustomUsername">Fecha de Inicio</label>
				      <div class="input-group">
				      
				        <input type="date" class="form-control" id="validationCustomUsername" placeholder=""  required>
				        <div class="invalid-feedback">
				          Please choose a username.
				        </div>
				      </div>
				    </div>
				  </div>
				  	 <button class="btn" type="button">Subir
				  	 	<img src="https://img.icons8.com/color/48/000000/import-csv.png">
				  	 </button>
				  	 <div class="row">
				  	 	 <button class="btn btn-primary" type="button">Crear</button>
				  	 </div>
				  	
				  
				  
				{{--   <div class="form-row">
				    <div class="col-md-6 mb-3">
				      <label for="validationCustom03">City</label>
				      <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
				      <div class="invalid-feedback">
				        Please provide a valid city.
				      </div>
				    </div>
				    <div class="col-md-3 mb-3">
				      <label for="validationCustom04">State</label>
				      <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
				      <div class="invalid-feedback">
				        Please provide a valid state.
				      </div>
				    </div>
				    <div class="col-md-3 mb-3">
				      <label for="validationCustom05">Zip</label>
				      <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
				      <div class="invalid-feedback">
				        Please provide a valid zip.
				      </div>
				    </div>
				  </div> --}}
				 
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
