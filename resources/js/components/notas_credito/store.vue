<template>
	<div class="container">
		<div  id="" class="justify-content-center text-center" >
        	<br>
        	<h4 class="text-center">Creando nota de credito</h4>
         	<br>
         	
         	<form>
			  <div class="form-row">
			    <div class="col-md-3 mb-3">
			      <label >CODIGO CLIENTE</label>
			      <input type="number" class="form-control"  v-model="cliente_id"  @keypress="onlyNumber" required>
			    </div>
			    <div class="col-md-3 mb-3">
			      <label for="validationDefault02">NOMBRE CLIENTE </label>
			      <input type="text" class="form-control" v-model="cliente_name" required>
			    </div>
			    <div class="col-md-3 mb-3">
			      <label for="validationDefault03">N° FACTURA</label>
			      <input type="number" class="form-control" v-model="factura" @keypress="onlyNumber" required>
			    </div>
			     <div class="col-md-3 mb-3">
				     <label for="validationDefault04">DESCRIPCION</label>
				     <input type="text" class="form-control"  v-model="descripcion" required>
				  </div>			   
				</div>
			  <div class="form-row">
			    <div class="col-md-3 mb-3">
			      <label for="validationDefault05">CANTIDAD CJ/DY/UN</label>
			      <input type="text" class="form-control"  v-model="cantidad" >
			    </div>
			    <div class="col-md-3 mb-3">
			      <label for="validationDefault06">DETALLE O MOTIVO</label>
			      <input type="text" class="form-control"  v-model="detalle" required>
			    </div>
			    <div class="col-md-3 mb-3">
			     	<label for="validationDefault07">MONTO BRUTO</label>
				      <div class="input-group">
				        <div class="input-group-prepend">
				          <span class="input-group-text" >$</span>
				        </div>
				        <input type="number" class="form-control"  v-model="monto" @keypress="onlyNumber" required>
				      </div>			      	
			    </div>
			     <div class="col-md-3 mb-3">
			      	<label for="validationDefault08">AUTORIZA</label>			      	
				     <select id="inputState" class="form-control" required v-model="autorizador_id">
				       <option selected disabled>Elegir...</option>
				       <option v-for="autorizador in autorizadores" :value="autorizador.id">{{ autorizador.nombre }}</option>
				     </select>
			    </div>		   
			  </div>			  
			  <button class="btn btn-primary"  type="button" @click.stop="postNota()">Guardar</button>
			</form>
     	</div>
	</div>	
</template>
<script>
export default {
  	data () {
		return {
		 	access_token: '',
         	 token_type: '', 
          	config:{},  
          	autorizadores:{},
          	cliente_id:'',
          	cliente_name:'',
          	factura:'',
          	descripcion:'',
          	cantidad:'',
          	detalle:'',
          	monto:'',
          	autorizador_id:'',
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
    	postNota(){
    		if((this.cliente_id != '' || this.cliente_name != '') &&  (this.factura != '') && (this.descripcion !='') && (this.detalle != '') && (this.monto != '') && (this.autorizador_id!= '')){
    			axios.post('/api/notas_credito',{
    		            'cliente_id' : this.cliente_id,
    		            'cliente_name' : this.cliente_name,
    		            'factura':this.factura,
    		            'descripcion':this.descripcion,
    		            'cantidad':this.cantidad,
    		            'detalle':this.detalle,
    		            'monto':this.monto,
    		            'autorizador_id' : this.autorizador_id,
    		        },this.config).then(response =>{
    		        	if(response.data == 'ok'){
    		        		alertify.set('notifier','position', 'top-right');
    		           		alertify.notify('Guardado', 'success', 3, function(){  console.log(); });   
    		           		window.location.href = '/notas_credito/create';         
    		        	}
                
    		        }).catch(error =>{	           
    		            alertify.set('notifier','position', 'top-right');
    		            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
    		        });

    		}
    		else{
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
	          }	          
	           this.getAutorizadores();
	           console.log(Vue.config.keyCodes);
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