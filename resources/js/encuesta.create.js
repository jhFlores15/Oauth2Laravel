
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
	},
	data:{
    	config:{},
    	configCliente:{},
    	tipos_encuesta:{},
    	select_tipo_encuesta:0,
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
    },
    methods:{   
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
    	postFileCliente(encuesta){
    		let formData = new FormData();            
            formData.append('csv', this.file);

            axios.post('/api/encuestas/clientes/'+encuesta.id,formData,this.configCliente)    			
		    .then(response =>{
		       console.log(response);		       
		    }).catch(error =>{
		    	if(error.response.status = 422){
                    this.erroresEncuesta = error.response.data.error;
                }
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
    }
     
});
