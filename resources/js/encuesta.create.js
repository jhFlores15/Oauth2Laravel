
require('./bootstrap');

// require('./jquery-3.2.1.min.js');

window.Vue = require('vue');

window.axios = require('axios');

import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);
const app = new Vue({
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
	      this.config = config;  
	      console.log("config"+config);  
    	}
    	this.getTiposEncuesta();
	},
	data:{
    	config:{},
    	tipos_encuesta:{},
    	select_tipo_encuesta:0,

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
    	}  
	}
     
});
