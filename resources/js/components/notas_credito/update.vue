<template>
	<div class="container">
		<div  id="" class="justify-content-center text-center" >
        	<br>
        	<h4 class="text-center">Editando nota de credito</h4>
         	<br>
         	<form>
			  <div class="form-row">
			    <div class="col-md-3 mb-3">
			      <label >CODIGO CLIENTE</label>
			      <input type="number" class="form-control"  v-model="nota.cliente_id"  @keypress="onlyNumber" required>
			    </div>
			    <div class="col-md-3 mb-3">
			      <label for="validationDefault02">NOMBRE CLIENTE</label>
			      <input type="text" class="form-control" v-model="nota.cliente_name" required>
			    </div>
			    <div class="col-md-3 mb-3">
			      <label for="validationDefault03">N° FACTURA</label>
			      <input type="number" class="form-control" v-model="nota.factura" @keypress="onlyNumber" required>
			    </div>
			     <div class="col-md-3 mb-3">
				     <label for="validationDefault04">DESCRIPCION</label>
				     <input type="text" class="form-control"  v-model="nota.descripcion" required>
				  </div>			   
				</div>
			  <div class="form-row">
			    <div class="col-md-3 mb-3">
			      <label for="validationDefault05">CANTIDAD CJ/DY/UN</label>
			      <input type="text" class="form-control"  v-model="nota.cantidad" >
			    </div>
			    <div class="col-md-3 mb-3">
			      <label for="validationDefault06">DETALLE O MOTIVO</label>
			      <input type="text" class="form-control"  v-model="nota.detalle" required>
			    </div>
			    <div class="col-md-3 mb-3">
			     	<label for="validationDefault07">MONTO BRUTO</label>
				      <div class="input-group">
				        <div class="input-group-prepend">
				          <span class="input-group-text" >$</span>
				        </div>
				        <input type="number" class="form-control"  v-model="nota.monto" @keypress="onlyNumber" required>
				      </div>	
				      <label><small class="text-muted">${{ nota.monto | numeral(0.0) }}</small></label>			      	
			    </div>
			     <div class="col-md-3 mb-3">
			      	<label for="validationDefault08">AUTORIZA</label>			      	
				     <select id="inputState" class="form-control" required v-model="nota.autorizadores_id">
				       <option selected disabled>Elegir...</option>
				       <option v-for="autorizador in autorizadores" :value="autorizador.id">{{ autorizador.nombre }}</option>
				     </select>
			    </div>		   
			  </div>
			  <div class="col text-center " v-if="(loading == true)">                
                    <div class="loader"  style="margin: auto;"></div>
                 </div>
                 <div class="col text-center" v-else>				  
			  		<button class="btn btn-primary"  type="button" @click.stop="putNota()">Guardar y Terminar</button>
			  </div>
			</form>
     	</div>
	</div>	
</template>
<script>
export default {
	props: ['id'],
  	data () {
		return {
		 	access_token: '',
         	 token_type: '', 
          	config:{},  
          	autorizadores:{},
          	loading:false,
          	nota:{
          		cliente_id:'',
          		cliente_name:'',
          		factura:'',
	          	descripcion:'',
	          	cantidad:'',
	          	detalle:'',
	          	monto:'',
	          	autorizadores_id:'',
	          	user_id:'',
          	}
          	
		}
	},  
    mounted(){
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
	        this.getUserApi();
	    }
	    else{
	      	window.location.href = '/';
	    }     
	},
    methods:{
    	 onlyNumber ($event) {
	         let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
	         if ((keyCode < 48 || keyCode > 57)) {
	            $event.preventDefault();
	         }
	      },
    	putNota(){
    		 this.loading = true;
    		if(
    			(
	    			((this.nota.cliente_id != '') &&  (this.nota.cliente_id != null ) ) || 
	    			((this.nota.cliente_name != '') && (this.nota.cliente_name != null))
	    		) && 
    			 ((this.nota.factura != '') && (this.nota.factura != null)) &&
    			  ((this.nota.descripcion !='') && (this.nota.descripcion != null)) &&
    			   ((this.nota.detalle != '') && (this.nota.detalle != null)) &&
    			    ((this.nota.monto != '') && (this.nota.monto != null)) && 
    			    ((this.nota.autorizadores_id!= '') && (this.nota.autorizadores_id!= null))
    		){
    			if(this.nota.monto <= 0){
    				this.loading = false;
    				 alertify.set('notifier','position', 'top-right');
    				 alertify.notify('Ingrese un Monto Valido', 'error', 3, function(){  console.log(); });     

    			}
    			else{
	    			axios.put('/api/notas_credito/'+this.id,{
	    		            'cliente_id' : this.nota.cliente_id,
	    		            'cliente_name' : this.nota.cliente_name,
	    		            'factura':this.nota.factura,
	    		            'descripcion':this.nota.descripcion,
	    		            'cantidad':this.nota.cantidad,
	    		            'detalle':this.nota.detalle,
	    		            'monto':this.nota.monto,
	    		            'autorizador_id' : this.nota.autorizadores_id,
	    		        },this.config).then(response =>{
	    		        	 this.loading = false;
	    		        	if(response.data == 'ok'){
	    		        		alertify.set('notifier','position', 'top-right');
	    		           		alertify.notify('Guardado', 'success', 3, function(){  console.log(); });   
	    		           		window.location.href = '/notas_credito/vendedor';  //listado       
	    		        	}
	                
	    		        }).catch(error =>{	
	    		        	this.loading = false;           
	    		            alertify.set('notifier','position', 'top-right');
	    		            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
	    		        });
	    		    }

    		}
    		else{
    			this.loading = false;
    			 alertify.set('notifier','position', 'top-right');
             	alertify.notify('Faltan Datos por ingresar', 'error', 3, function(){  console.log(); });  
    		}
    	},
	    getUserApi(){       
	      axios.get('/api/user/',this.config).
	        then(response => {
	          var user = response.data;
	          if(user.rol_id != 2 ){
	            window.location.href = '/';
	          }else{
	          	 axios.get('/api/notas_credito/'+this.id,this.config).
			        then(response => {
			          this.nota = response.data;
			          if(this.nota.user_id != user.id ){
			            window.location.href = '/';
			          }	else{
			          		this.getAutorizadores();
			          }          
			        }).catch(error => {
			         
			        })
	          }
	      }).catch(error => {
	         
	        })
	    },
	    getAutorizadores(){       
	      axios.get('/api/autorizadores/',this.config).
	        then(response => {
	          this.autorizadores = response.data;
	        }).catch(error => {
	         
	        })
	    },
	},
}
</script>