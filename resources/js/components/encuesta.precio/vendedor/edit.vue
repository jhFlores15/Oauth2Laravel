<template>
	<div class="container">
		<div  id="" class="justify-content-center text-center" >
        	<br>
        	<h4 class="text-center">Encuestando a {{ cliente.razon_social }}</h4>
         	<br>
         	<h6 class="text-center">Responder a la pregunta, ¿Esta este Producto en el local?</h6>
         	<div class="card card-body" style="margin:auto;" v-for="(marca , i) in marcas" :key="marca[0].categoria.id">
         		<h5 class="text-center">Categoria : {{ marca[0].categoria.nombre}}</h5>
         		<div class="card card-body" style="margin:auto;" >
         			<b-form inline v-for="marc in marca" :key="marc.id">
					    <label class="mr-sm-2" for="inline-form-custom-select-pref">{{ marc.nombre }}  &nbsp&nbsp&nbsp</label>
               <input type="number" class="form-control"v-for="mc in cli_marcas" :key="mc.id" v-if="(mc.marca_id == marc.id)" v-on:input="postMarca(mc.valor,mc.id)"
                  v-model="mc.valor"> 
					 </b-form>
         		</div>
         	</div>
         	<button type="button" class="text-center btn btn-primary" v-on:click.stop="terminar()">Terminar</button>
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
          cli_marcas:[],
          marcas_se:[],

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
      this.getCliente();
      this.getEncuesta();   
      this.getEncuestaE(); 
      this.getMarcas();      
    }
     
  },
  methods:{
  	terminar(){  		
        location.href = '/encuestas/E/P/'+this.encuesta_id;
  	},
  	postMarca(valor,id){
      if((isNaN(valor) == false) && (valor != '')){
        if(valor > 0){
      		axios.put('/api/encuestas/precio/'+id,{
                'valor' : valor,
            },this.config).then(response =>{
            	
            }).catch(error =>{
                alertify.set('notifier','position', 'top-right');
                alertify.notify('Error', 'error', 3, function(){  console.log(); });                
            });
          }
          else{
            alertify.set('notifier','position', 'top-right');
            alertify.notify('Los datos ingresados deben ser >= 0', 'error', 3, function(){  console.log(); });   
          }
      }
      else{
         alertify.set('notifier','position', 'top-right');
         alertify.notify('Los datos ingresados deben ser numeros', 'error', 3, function(){  console.log(); });   
      }
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
		axios.get('/api/encuestas/cli_marca/'+this.cliente_id+'/'+this.encuesta_id,this.config).			
	        then(response => {	
	         	this.cli_marcas= response.data;         
	        }).catch(error => {
	          console.log(error)
	        })
	},
    
  }
}
</script>
