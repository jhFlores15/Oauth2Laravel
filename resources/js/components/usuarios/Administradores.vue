<template>
    <div class="container-fluid" >
	<br>
	<div id="" class="justify-content-center">
		    <b-button variant="primary">
    Notifications <b-badge variant="light">4</b-badge>
  </b-button>
		    
	</div>
	 <table id="administradores" class="table table-striped table-bordered" style="width: 100%">
		<thead> 
		<tr>
			<th>Razon Social</th>
			<th>Email</th>
			<th>Rut</th>
			<th>password</th>
		</tr>
	</thead>
	<tbody>
			<tr v-for="user in users">
				<td>{{ user.razon_social }}</td>
				<td>{{ user.email }}</td>
				<td>{{ user.rut  }} - {{  user.dv  }}</td>	
				<td>{{ user.password_visible }}</td>
			</tr>
	</tbody>
	</table>
</div>
</template>
<script>
$(document).ready(function(){
	$('#administradores').DataTable({
		paging: true,
		ordering: true

	});
});
</script>
<script>
export default {
  data () {
      return {  
          access_token: 0,
          token_type: '', 
          config:{},
          users:[],
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
      }
      this.config = config;  
      this.getAdministradores();
    }
    else{
    	location.href = 'http://localhost:3000/';
    }
     
  },
  created:function(){
  
  
  },
  methods:{
   	getAdministradores(){
   		axios.get('/api/administradores/',this.config).
        then(response => {
          	this.users= response.data;
        }).catch(error => {
          console.log(error)
        });   		
   	},
   	postAdministradores(){
		axios.post('/api/administradores',{
	      razon_social : this.razon_social,
	      email : this.email, 
	      password : this.password,
	      codigo : this.email,
	      rut : this.razon_social,
	      dv : this.email,
	      rol_id : this.razon_social,
      	}).then(response =>{
        	console.log(response.data);
      	}).catch(error =>{
              
     	});
   	},
   	deleteAdministradores(){
   		axios.delete('/api/user/',this.config).
        then(response => {
          	this.users= response.data;
        }).catch(error => {
          console.log(error)
        });  

   	}
    
  }
   
}
 
</script>