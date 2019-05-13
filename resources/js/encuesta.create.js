
require('./bootstrap');

// require('./jquery-3.2.1.min.js');

window.Vue = require('vue');

window.axios = require('axios');

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);
const appp = new Vue({
    el: '#encuesta_create',
    mounted() {
        console.log("montado");
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
         // producto:{
         //    nombre:'',
         //    tipo:0,
         // },
         nombre:'',
         tipo:0,
    },
    methods:{
        postEncuestaExistente(){
            axios.post('/api/encuestas/existencia',{              
                'descripcion' : this.descripcion,
                'fecha_inicio' : this.fecha_inicio,
                'tipo_encuesta' : this.select_tipo_encuesta,  
                'categorias' : this.categorias,
        
            },this.config).then(response =>{
                location.href='/encuestas/existencia/'+response.data.id;/////ir a ver encuesta           
            }).catch(error =>{
                if(error.response.status = 422){
                    this.erroresEncuesta = error.response.data.error;
                }
                alertify.set('notifier','position', 'top-right');
                alertify.notify('No se han guardado los cambios', 'error', 10, function(){  console.log(); });                
            });

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
                if(this.categoria.productos.length !== 0){
                    this.categorias.push(this.categoria);
                     this.categoria={
                        nombre:'',
                        productos:[],
                     }
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
	    // handleFileUpload(){
	    // 	 this.formData = new FormData();
    	// 	this.formData.append('name', this.fileName);
    	// 	this.formData.append('file', this.$refs.file.files[0]);
    	// 	console.log(this.formData);
	    // },
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
    		let formData = new FormData();            
            formData.append('csv', this.file);

            axios.post('/api/encuestas/clientes/'+encuesta.id,formData,this.configCliente)    			
		    .then(response =>{
		       location.href='/encuesta/clientes/'+encuesta.id;	       
		    }).catch(error =>{
		    	if(error.response.status = 422){
                    this.erroresEncuesta = error.response.data.error;
                }
               
                this.eliminarEncuesta(encuesta.id);

		    });
    		
    	},
    	postEncuestaCliente(){    		
    		axios.post('/api/encuestas/clientes',{    			
    			'descripcion' : this.descripcion,
    			'fecha_inicio' : this.fecha_inicio,
    			'tipo_encuesta' : this.select_tipo_encuesta,  
        
		    },this.config).then(response =>{
		       this.postFileCliente(response.data);
		       
		    }).catch(error =>{
                if(error.response.status = 422){
                    this.erroresEncuesta = error.response.data.error;
                }
		    	
		    });
    	},
        eliminarEncuesta(id){
            // axios.delete('/api/encuestas/'+id, {this.config});

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
