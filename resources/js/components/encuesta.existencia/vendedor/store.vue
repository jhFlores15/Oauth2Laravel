<template>
	<div class="container">
		<div  id="" class="justify-content-center text-center" >
        	<br>
        	<h4 class="text-center">Encuestando a {{ cliente.razon_social }}</h4>
         	<br>
         	<h6 class="text-center">Responder a la pregunta, ¿Esta este Producto en el local?</h6>
         	<div class="card card-body" style="margin:auto;" v-for="(marca , i) in marcas" :key="marca[0].categoria.id">
         		<h5 class="text-center">Categoria : {{ marca[0].categoria.nombre}}</h5>
         			<b-form inline v-for="marc in marca" :key="marc.id" style="margin:auto;">
					    <label class="mr-sm-2" for="inline-form-custom-select-pref">{{ marc.nombre }} &nbsp&nbsp&nbsp</label>
					    <b-form-radio-group
					    	v-on:input="postMarca(marc.tipo_producto.created_at,marc.id)"
					        v-model="marc.tipo_producto.created_at"
					        :options="options"
					        name="radio-inline"
					    ></b-form-radio-group>					    
					 </b-form>
         	</div>
          <div  class="text-center" v-if="loader == true">
            <div class="loader"></div>
          </div>
          <div v-else>
            <button type="button" class="text-center btn btn-primary" v-on:click.stop="terminar()">Terminar</button>
          </div>
         	
     	</div>
	</div>
	
</template>
<script>
export default {
    props: ['cliente_id','encuesta_id'],
  data () {
      return {           
          access_token: 0,
          token_type: '',   
          config:{},
          cliente:{
            razon_social:'',
          },
          encuesta:{},     
          categorias:{},
          marcas:[], 
          options: [
          { text: 'Si', value: 1 },
          { text: 'No', value: 0 },
          ],
          selected:'',
          marca_producto:[],
          marca_cliente:'',
          marcas_se:[],
          loader:false,

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
      this.getUserApi();
    }
    else{
      // window.location.href = '/';
    }
  },
  methods:{
    getUserApi(){     
       this.getCliente();   
      axios.get('/api/user/',this.config).
        then(response => {
          var user = response.data;
          if(user.rol_id != 2 || user.id != this.cliente.user_id){
            window.location.href = '/';
          } 
          this.getEncuesta();   
          this.getEncuestaE(); 
          this.getMarcas();      
        }).catch(error => {
         
        })
    },  
    verifi(c,marcs){
      if(Object.keys(c).length == marcs.length){
            location.href = '/encuestas/E/P/'+this.encuesta_id;
      }
      else{
        alertify.set('notifier','position', 'top-right');
          alertify.notify('Faltan productos por encuestar', 'error', 10, function(){  console.log(); });
        }

    },
  	terminar(){
      this.loader = true;
  		axios.get('/api/encuestas/cli_marca/'+this.cliente_id+'/'+this.encuesta_id,this.config).
        then(response => { 
          this.loader = false;
        	var marcs = response.data;
          this.verifi(marcs,  this.marcas_se);
        }).catch(error => {
          this.loader = false;
          console.log(error)
        })
        
  	},
  	postMarca(valor,marca_id){
  		var marca_cliente = {};
  		axios.get('/api/encuestas/cli_marca_s/'+this.cliente_id+'/'+marca_id,this.config).
        then(response => {        	
         	marca_cliente = response.data;         
         	  if(marca_cliente.id != undefined){ //actualizar
	        	axios.put('/api/encuestas/existencia/'+marca_cliente.id,{
		            'valor' : valor,
		        },this.config).then(response =>{
               alertify.set('notifier','position', 'top-right');
                alertify.notify('Ok', 'success', 2, function(){  console.log(); });
		        	
		        }).catch(error =>{
		            alertify.set('notifier','position', 'top-right');
		            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
		        });

	        }else{//post
	        	axios.post('/api/encuestas/existencia',{
		            'marca_id' : marca_id,
		            'cliente_id' : this.cliente_id,
		            'encuesta_id' : this.encuesta_id,
		            'valor' : valor,
		        },this.config).then(response =>{
		           alertify.set('notifier','position', 'top-right');
              alertify.notify('Ok', 'success', 2, function(){  console.log(); });
		        }).catch(error =>{	           
		            alertify.set('notifier','position', 'top-right');
		            alertify.notify('Error', 'error', 3, function(){  console.log(); });                
		        });
	        }

        }).catch(error => {
          console.log(error)
        })
  	},
    getCliente(){
        axios.get('/api/clientes/'+this.cliente_id,this.config).
            then(response => {
              this.cliente= response.data;
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
      getEncuestaE(){
		axios.get('/api/encuestas/existencia/'+this.encuesta_id+'/edit',this.config).			
	        then(response => {
	        	var array = []; 
	          	this.marcas= response.data[0].marcas;	          	
	        }).catch(error => {
	          console.log(error)
	        })
	},
	getMarcas(){
		axios.get('/api/marcas/'+this.encuesta_id,this.config).			
	        then(response => {	
	         	this.marcas_se= response.data;         
	        }).catch(error => {
	          console.log(error)
	        })
	},
    
  }
}
</script>
