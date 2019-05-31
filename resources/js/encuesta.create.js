
require('./bootstrap');

// require('./jquery-3.2.1.min.js');

window.Vue = require('vue');

window.axios = require('axios');

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);
const appp = new Vue({
    el: '#encuesta_create',
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
	        let configC = {
	        headers: {
	         'Content-Type': 'multipart/form-data' ,
	         'Authorization':this.token_type + " " + this.access_token,
	        },
	      }; 
	      this.config = config;  
	      this.configCliente = configC; 
    	}
    	this.getTiposEncuesta();
        this.getTiposProductos();
	},
	data:{
    	config:{},
    	configCliente:{},
    	tipos_encuesta:{},
        tipos_productos:{},
    	select_tipo_encuesta:0,
        select_tipo_producto:0,
    	descripcion:'',
    	fecha_inicio:'',
    	csv:'',
    	erroresEncuesta:{
            descripcion:'',
            tipos_encuesta:'',
            fecha_inicio:'',
            csv:'',
        },
    	file:'',
        categorias:[],
         categoria:{
            nombre:'',
            productos:[],
         },
         nombre:'',
         tipo:0,
         loaderCliente:false,
         loaderExistente:false,
    },
    methods:{
        changeTipoEncuesta(){
            if(this.select_tipo_encuesta == 2){
                alertify.set('notifier','position', 'top-right');
                alertify.notify('Recuerde que luego de crear esta encuesta debe verificar que la cantidad de registros que tiene su archivo sea la misma que se ha subido', 'error', 20, function(){  console.log(); });
            }

        },
        postEncuestaExistente(){
            if((this.descripcion != '') && (this.fecha_inicio!= '') && (this.categorias.length > 0)){
                this.loaderExistente = true;
                this.erroresEncuesta = "";
                axios.post('/api/encuestas',{              
                    'descripcion' : this.descripcion,
                    'fecha_inicio' : this.fecha_inicio,
                    'tipo_encuesta' : this.select_tipo_encuesta,  
                    'categorias' : this.categorias,
            
                },this.config).then(response =>{
                    this.loaderExistente = false;
                    if(this.select_tipo_encuesta == 1){
                        location.href='/encuestas/E/'+response.data.id;/////ir a ver encuesta           
                    }
                    else if(this.select_tipo_encuesta == 3){
                        location.href='/encuestas/P/'+response.data.id;/////ir a ver encuesta    
                    }
                }).catch(error =>{
                    this.loaderExistente = false;
                    if(error.response.status == 422){
                        this.erroresEncuesta = error.response.data.error;
                    }
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('No se han guardado los cambios', 'error', 10, function(){  console.log(); });                
                });
                 

            }
            else{
                alertify.set('notifier','position', 'top-right');
                alertify.notify('Aun faltan datos para crear la encuesta', 'error', 10, function(){  console.log(); });   
            }
            

        },
        agregarProducto(){
            if((this.nombre !== '') && (this.tipo !== 0 && this.tipo !== '')){
                var producto ={
                    nombre : this.nombre,
                    tipo : this.tipo,
                };
                this.categoria.productos.push(producto);
                this.nombre='';
                this.tipo=0;
            }
           
        },
        agregarCategoria(){
            if(this.categoria.nombre !== ''){
                if (this.categoria.productos.length !== 0){
                    // if((this.nombre !== '') && (this.tipo !== 0 && this.tipo !== '')){
                    //     alertify.confirm('¿Olvido Producto?', '¿UPS! ah olvidado agregar un producto a esta categoria?', 
                    //         function(){ }
                    //         , function() use( this.categorias, this.categoria){
                    //             this.categorias.push(this.categoria);
                    //              this.categoria={
                    //                 nombre:'',
                    //                 productos:[],
                    //              }
                                  
                    //         }).set('labels', {ok:'Si!', cancel:'No!'});
                    // }
                    // else{
                        this.categorias.push(this.categoria);
                         this.categoria={
                            nombre:'',
                            productos:[],
                         }
                    // }    
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
    	selectedFile(event) {
  	      this.file = event.target.files[0];
  	    },
    	getTiposEncuesta(){
    		axios.get('/api/tipos_encuesta/',this.config).
		        then(response => {
		          this.tipos_encuesta= response.data;
		          console.log(this.tipos_encuesta);
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
    	postFileCliente(encuesta){
           this.erroresEncuesta.descripcion ='';
         this.erroresEncuesta.tipos_encuesta ='';
         this.erroresEncuesta.fecha_inicio ='';
         this.erroresEncuesta.csv ='';  
             this.loaderCliente = true;
    		let formData = new FormData();            
            formData.append('csv', this.file);

            axios.post('/api/encuestas/clientes/'+encuesta.id,formData,this.configCliente)    			
		    .then(response =>{
                this.loaderCliente = false;
		       location.href='/encuesta/clientes/'+encuesta.id;	       
		    }).catch(error =>{
                console.log('error');
                this.loaderCliente = false;
		    	if(error.response.status == 422){
                    this.erroresEncuesta = error.response.data.error;
                }  
                else if(error.response.status == 500)
                {
                    console.log(error.response)
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify(error.response.data.message, 'error', 10, function(){  console.log(); });
                }             
                this.eliminarEncuesta(encuesta.id);
		    });
            
    		
    	},
    	postEncuestaCliente(){  
         this.erroresEncuesta.descripcion ='';
         this.erroresEncuesta.tipos_encuesta ='';
         this.erroresEncuesta.fecha_inicio ='';
         this.erroresEncuesta.csv ='';		
         this.loaderCliente = true;
    		axios.post('/api/encuestas/clientes',{    			
    			'descripcion' : this.descripcion,
    			'fecha_inicio' : this.fecha_inicio,
    			'tipo_encuesta' : this.select_tipo_encuesta,  
        
		    },this.config).then(response =>{
                this.loaderCliente = false;
		       this.postFileCliente(response.data);
		       
		    }).catch(error =>{
                if(error.response.status == 422){
                    this.loaderCliente = false;
                    this.erroresEncuesta = error.response.data.error;
                }
		    	
		    });
    	},
        eliminarEncuesta(id){
             axios.delete('/api/encuestas/clientes/'+id,this.config).then(response=>{
                console.log(response);
            }).catch(error=>{
                console.log(error);
                if(error.response.status==500){
                    alert("no se ha podido realizar esta accion");
                }
            })
        },        
    }
     
});
