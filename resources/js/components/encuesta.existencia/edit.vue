<template>
	<div class="justify-content-center text-center">
		<h2 class="text-center">Editar Encuesta</h2>
		<br>	
		<div class="row text-center d-flex justify-content-center">
			<div class="col-md-8">
				<form class="needs-validation" novalidate>
				  <div class="form-row">
				    <div class="col-md-4 mb-3">
				      <label for="validationCustom01">Descripcion</label>
				      <input type="text" class="form-control" id="validationCustom01" placeholder="Descripcion" v-on:change="putEncuesta()" v-model.lazy="encuesta.descripcion" required>
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
				        <input type="date" class="form-control"  id="validationCustomUsername" placeholder=""  v-on:change="putEncuesta()" required v-model="encuesta.inicio">				        	
				      </div>
				      <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.fecha_inicio" >{{ erroresEncuesta.fecha_inicio[0] }}</div>
				    </div>
				  </div>
				</form>
				<div class="text-right">
					<button class="btn btn-primary ml-auto text-left" style="text-align:right !important;" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
				   Agregar Categoria
				 </button>
				</div>				
				 <div class="collapse ml-auto" id="collapseExample">
				  <div class="card card-body" style="margin:auto;">
				   <form>
				  		<div class="form-row">							  		
				  			<div class="form-group col-md-4">
							      <label for="inputEmail4">Categoria</label>
							      <input type="text" class="form-control" id="inputEmail4" required v-model="nombreC">
							      <br><br>
							      <b-button v-b-tooltip.hover variant="light" size="sm" v-on:click.stop="postCategoria()" title="Guardar Categoria y sus productos">
									<img src="https://img.icons8.com/color/30/000000/plus.png">
						    	 </b-button>
						  	</div>
						  	<div class="form-group col-md-8">						  	
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
								<form >
				  					<div class="form-row">	
									    <div class="form-group col-md-5">
									      <input type="text" class="form-control" id="inputPassword4" placeholder="Quaker / Trencito"  v-model="nombreM">
									    </div>
									     <div class="form-group col-md-5">
									      <select   class="form-control" v-model="tipoM">
									     	<option v-for="tipo in tipos_productos" :value="tipo.id">{{ tipo.nombre}}</option>
									     </select>
									    </div>
									    <div class="form-group col-md-2">									    	
									    	 <b-button v-b-tooltip.hover variant="light" size="sm" v-on:click.stop="agregarMarca(i)" title="Agregar Producto/Marca">
												<img src="https://img.icons8.com/color/30/000000/plus.png">
									    	 </b-button>
									    </div>
									</div>												 
								</form>	
								<div v-for="producto in productos">
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

				    	</div>	
					</form>
				  </div>
				</div>
				<div class="justify-content-center text-center">
					<div class="col-md-12"  v-for="(marca , i) in marcas" :key="marca[0].categoria.id">				  	 	
				  	 	<div class="card card-body" style="margin:auto;">	
				  	 		<form>
						  		<div class="form-row">							  		
						  			<div class="form-group col-md-4">
									    <label for="inputEmail4">Categoria</label>
									    <input type="text" class="form-control" id="inputEmail4" @change.prevent="putCategoria(marca[0].categoria)" v-on:keyup.enter.prevent="putCategoria(marca[0].categoria)" v-model.lazy=" marca[0].categoria.nombre" required>
										<br><br>
										<b-button v-b-tooltip.hover variant="light" size="sm" v-on:click.stop="deleteCategoria(marca[0].categoria)" title="Eliminar Categoria y sus Productos/Marcas">
											<img src="https://img.icons8.com/flat_round/30/000000/delete-sign.png">
								    	</b-button>
								 	 </div>
								 	<div class="form-group col-md-8">
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
											      <input type="text" class="form-control" id="inputPassword4" placeholder="Quaker / Trencito" v-model.lazy="marc.nombre" v-on:change.prevent="putMarca(marc)" v-on:keyup.enter.prevent="putMarca(marc)">
											    </div>
											     <div class="form-group col-md-5">
											      <select   class="form-control" v-model.lazy="marc.tipo_producto.id" v-on:change.prevent="putMarca(marc)" v-on:keyup.enter.prevent="putMarca(marc)">
											     	<option v-for="tipo in tipos_productos" :value="tipo.id">{{ tipo.nombre}}</option>
											     </select>
											    </div>
											    <div class="form-group col-md-2">
											    	<b-button v-b-tooltip.hover variant="light" size="sm" v-on:click.stop="deleteProducto(marc)" title="Eliminar">
														<img src="https://img.icons8.com/flat_round/25/000000/delete-sign.png">
											    	 </b-button>
											    </div>
											 </div>	
										</form>
										<form >
						  					<div class="form-row">	
											    <div class="form-group col-md-5">
											      <input type="text" class="form-control" id="inputPassword4" placeholder="Quaker / Trencito" v-model.lazy="marca_producto[i].nombre"  >
											    </div>
											     <div class="form-group col-md-5">
											      <select   class="form-control" v-model.lazy="marca_producto[i].tipo_producto_id" >
											     	<option v-for="tipo in tipos_productos" :value="tipo.id">{{ tipo.nombre}}</option>
											     </select>
											    </div>
											    <div class="form-group col-md-2">
											    	 <b-button v-b-tooltip.hover variant="light" size="sm" v-on:click.stop="postProducto(i)" title="Agregar Producto/Marca">
														<img src="https://img.icons8.com/color/30/000000/plus.png">
											    	 </b-button>
											    </div>
											</div>												 
										</form>
																		
										</div>	
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
          erroresCategoria:[],
          tipos_productos:[],
          marcas:[],
          marca_producto:[],
          nombreC:'',
          productos:[],
          nombreM:'',
          tipoM:0,
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
  	postCategoria(){
  		if(this.nombreC !== ''){
            if(this.productos.length !== 0){
            	axios.post('/api/categorias/',{
		            'nombre' : this.nombreC,
		            'marcas' :this.productos, 
		            'encuesta_id' :this.encuesta_id,  
		        },this.config).then(response =>{
		        	alertify.set('notifier','position', 'top-right');
		        	alertify.notify('Guardado', 'success', 3, function(){  console.log(); });
		        	location.reload(true);
		        }).catch(error =>{
		            if(error.response.status = 422){
		                this.erroresCategoria = error.response.data.error;
		            }
		            alertify.set('notifier','position', 'top-right');
		            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
		        });              
            }
            else{
                alertify.set('notifier','position', 'top-right');
                alertify.notify('Ingrese Productos a esta categoria', 'error', 10, function(){  console.log(); });
            }                
        }
         else{
            alertify.set('notifier','position', 'top-right');
            alertify.notify('Ingrese nombre de Categoria', 'error', 10, function(){  console.log(); });
        }
  	},
  	agregarMarca(){
        if((this.nombreM !== '') && (this.tipoM !== 0 && this.tipoM !== '')){
            var producto ={
                nombre : this.nombreM,
                tipo : this.tipoM,
            };
            this.productos.push(producto);
            this.nombreM='';
            this.tipoM=0;
        }
           
        },
  	deleteCategoria(categoria){
  		var config = this.config;
  		alertify.confirm('Esta Seguro de Eliminar esta Categoria', 'Nombre: '+categoria.nombre, function(){
  			axios.delete('/api/categorias/'+categoria.id,config).then(response=>{
  				location.reload(true);  				  				
	  		}).catch(error=>{
                alertify.set('notifier','position', 'top-right');
	            alertify.notify('Error', 'error', 3, function(){  console.log(); });      
	            
	        })

  		}, function(){ });  		
  	},
  	deleteProducto(marca){
  		var config = this.config;
  		alertify.confirm('Esta Seguro de Eliminar este Producto/Marca', 'Nombre: '+marca.nombre, function(){
  			axios.delete('/api/marcas/'+marca.id,config).then(response=>{
  				if(response.data != 'ok'){
  					alertify.set('notifier','position', 'top-right');
	            	alertify.notify(response.data, 'error', 3, function(){  console.log(); });   
  				}
  				else{
  					location.reload(true);
  				}  				
	  		}).catch(error=>{
	            console.log(error);
	            if(error.response.status==500){
	                alertify.set('notifier','position', 'top-right');
		            alertify.notify('Error', 'error', 3, function(){  console.log(); });      
	            }
	        })

  		}, function(){ });  		
  	},
  	postProducto(i){
  		var objeto = this.marca_producto[i];
  		if(objeto.nombre !== '' && objeto.tipo_producto_id){
  			axios.post('/api/marcas',{
	            'nombre' : objeto.nombre,
	            'tipo_producto_id' : objeto.tipo_producto_id,
	            'categoria_id' : i,
	            'encuesta_id': this.encuesta_id,
	        },this.config).then(response =>{
	        	location.reload(true);
	        }).catch(error =>{
	            if(error.response.status = 422){
	                this.erroresCategoria = error.response.data.error;
	            }
	            alertify.set('notifier','position', 'top-right');
	            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
	        });
  		}
  		console.log();
  	},  
  	putMarca(marca){
  		axios.put('/api/marcas/'+marca.id,{
            'nombre' : marca.nombre,
            'tipo_producto_id' : marca.tipo_producto.id,
            'categoria_id' : marca.categoria.id,
        },this.config).then(response =>{
        	alertify.set('notifier','position', 'top-right');
        	alertify.notify('Guardado', 'success', 3, function(){  console.log(); });
        }).catch(error =>{
            if(error.response.status = 422){
                this.erroresCategoria = error.response.data.error;
            }
            alertify.set('notifier','position', 'top-right');
            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
        });
  	},
  	putCategoria(categoria){
        axios.put('/api/categorias/'+categoria.id,{

            'nombre' : categoria.nombre,   
        },this.config).then(response =>{
        	alertify.set('notifier','position', 'top-right');
        	alertify.notify('Guardado', 'success', 3, function(){  console.log(); });
        }).catch(error =>{
            if(error.response.status = 422){
                this.erroresCategoria = error.response.data.error;
            }
            alertify.set('notifier','position', 'top-right');
            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
        });
  	},
  	putEncuesta(){
        axios.put('/api/encuestas/'+this.encuesta_id,{              
            'descripcion' : this.encuesta.descripcion,
            'fecha_inicio' : this.encuesta.inicio,    
        },this.config).then(response =>{
        	alertify.set('notifier','position', 'top-right');
        	alertify.notify('Guardado', 'success', 3, function(){  console.log(); });
        }).catch(error =>{
            if(error.response.status = 422){
                this.erroresEncuesta = error.response.data.error;
            }
            alertify.set('notifier','position', 'top-right');
            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
        });
  	},
  	getTiposEncuesta(){
		axios.get('/api/tipos_encuesta/',this.config).
	        then(response => {
	          this.tipos_encuesta= response.data;
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
            }).catch(error => {
              console.log(error)
            })
    },
    getEncuestaE(){
		axios.get('/api/encuestas/existencia/'+this.encuesta_id+'/edit',this.config).			
	        then(response => {
	        	var array = []; 
	          this.marcas= response.data[0].marcas;
	          for (const marca in this.marcas){          	
	          	var num=[];
	          	var i=0;
	          	do{
	          		console.log(marca[i]);
          			num.push(marca[i]);
          			i++;
	          	}
	          	while( (marca[i] ) || (!isNaN(marca[i])) );

	          	array.push(num.join(''));
	          }
	          	for (var i = 0; i < array.length; i++) {
	          		this.marca_producto[array[i]] ={
	          			nombre:'',tipo_producto_id:0,
	          		} 
	          	}
	        }).catch(error => {
	          console.log(error)
	        })
	},


    
  }
}
</script>