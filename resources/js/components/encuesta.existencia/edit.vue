<template>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Editar Encuesta</h2>
		<br>	
		<div class="row text-center justify-content-center">
			<div class="col-md-8">
				<form class="needs-validation" novalidate>
				  <div class="form-row">
				    <div class="col-md-4 mb-3">
				      <label for="validationCustom01">Descripcion</label>
				      <input type="text" class="form-control" id="validationCustom01" placeholder="Descripcion" v-model="encuesta.descripcion" required>
				      <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.descripcion" >{{ erroresEncuesta.descripcion[0] }}</div>
				  	</div>
				    <div class="col-md-4 mb-3">
					      <label for="validationCustom02">Tipo Encuesta</label>
					    <div v-for="tipo in tipos_encuesta" v-if="encuesta.tipo_encuesta_id == tipo.id">
				     		<input type="text" readonly  class="form-control-plaintext text-center"  id="inputPassword4" v-model="tipo.nombre" >
				     	</div>	
					     <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.tipos_encuesta" >{{ erroresEncuesta.tipos_encuesta[0] }}</div>
					  </div>		
				    <div class="col-md-4 mb-3">
				      <label for="validationCustomUsername" >Fecha de Inicio</label>
				      <div class="input-group">				      
				        <input type="date" class="form-control"  id="validationCustomUsername" placeholder=""  required v-model="encuesta.inicio">				        	
				      </div>
				      <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.fecha_inicio" >{{ erroresEncuesta.fecha_inicio[0] }}</div>
				    </div>
				  </div>
				</form>
				<div class="justify-content-center text-center">
					<div class="col-md-12"  v-for="marca in marcas" >				  	 	
					  	 	<div class="card card-body" style="margin:auto;">
					  	 		<form>
							  		<div class="form-row">							  		
							  			<div class="form-group col-md-4">
									      <label for="inputEmail4">Categoria</label>
									      <input type="text" class="form-control" id="inputEmail4" v-model=" marca[0].categoria.nombre">									      
									    </div>
										<div class="card card-body" style="margin:auto;">
											<form>
							  					<div class="form-row">	
												    <div class="form-group col-md-5">
												      <label for="inputPassword4">Marca/Producto</label>
												  	</div>
												     <div class="form-group col-md-5">
												      <label for="inputPassword4">Tipo Producto</label>
												  </div>
												    <div class="form-group col-md-2">
												    	
												    </div>
												 </div>	
											</form>
											<form v-for="marc in marca">
							  					<div class="form-row">	
												    <div class="form-group col-md-5">
												      <input type="text" class="form-control" id="inputPassword4" placeholder="Quaker / Trencito" v-model="marc.nombre">
												    </div>
												     <div class="form-group col-md-5">
												      <select   class="form-control" v-model="marc.tipo_producto.id">
												     	<option v-for="tipo in tipos_productos" :value="tipo.id">{{ tipo.nombre}}</option>
												     </select>
												    </div>
												    <div class="form-group col-md-2">
												    	
												    </div>
												 </div>	
											</form>						
										</div>								  		
							    	</div>	
								</form>							
					  	 	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

</template>
<script>
export default {
    props: ['encuesta_id'],
  data () {
      return {           
          access_token: 0,
          token_type: '',   
          config:{},
          tipos_encuesta:[],
          encuesta:[],
          erroresEncuesta:[],
          tipos_productos:[],
          marcas:[],
      }
  },
  
  mounted() {   
    if (localStorage.access_token){        
      this.access_token = localStorage.access_token;
      this.token_type = localStorage.token_type;
      let config = {
        headers: {
         'Content-Type': 'application/json' ,
         'Authorization':this.token_type + " " + this.access_token,
        },
      }; 
      this.config = config; 
      this.getTiposEncuesta();
      this.getEncuesta(); 
      this.getTiposProductos(); 
      this.getEncuestaE();    
    }
     
  },
  created:function(){
  
  
  },
  methods:{
  	getTiposEncuesta(){
		axios.get('/api/tipos_encuesta/',this.config).
	        then(response => {
	          this.tipos_encuesta= response.data;
	          console.log(this.tipos_encuesta);
	        }).catch(error => {
	          console.log(error)
	        })
	},
	getEncuesta(){
		axios.get('/api/encuestas/'+this.encuesta_id,this.config).
	        then(response => {
	          this.encuesta= response.data;
	        }).catch(error => {
	          console.log(error)
	        })
	},
	 getTiposProductos(){
        axios.get('/api/tipos_productos/',this.config).
            then(response => {
              this.tipos_productos= response.data;
              console.log(this.tipos_productos);
            }).catch(error => {
              console.log(error)
            })
    },
    getEncuestaE(){
		axios.get('/api/encuestas/existencia/'+this.encuesta_id,this.config).
	        then(response => {
	          this.marcas= response.data[0].marcas;
	        }).catch(error => {
	          console.log(error)
	        })
	},


    
  }
}
</script>