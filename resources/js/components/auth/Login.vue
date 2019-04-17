<template>
    <div class="container">
      <div class="dropdown">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
         <form class="dropdown-menu p-4">        
          <div class="form-group">
             <label for="dropdown-login">Email</label>
             <input type="email"  class="form-control" @keyup.enter='postLogin()' placeholder="email@example.com" v-model="email">
          </div>
          <div class="form-group">
             <label for="dropdown-login">Password</label>
             <input type="password"  class="form-control" @keyup.enter='postLogin()' placeholder="Password" v-model="password">
          </div>
          <div class="col text-center">
            <button type="button" @click.stop='postLogin()'  class="btn btn-primary ">Aceptar</button>
          </div>
          <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">¿Olvidaste tu Contraseña?</a>
          
      </form>
      </div>
     
      
    </div>
</template>
<script>
export default {
  data () {
      return {  
          user: {},
          access_token: 0,
          token_type: '',
          headers : {
            headers:{
               'Content-Type': 'application/json' ,
               'Authorization': this.token_type+' '+ this.access_token,
            }
          },
          email: '',
          password: '',
      }
  },
  mounted() {
      if (localStorage.access_token){
        this.access_token = localStorage.access_token;
        this.token_type = localStorage.token_type;
      }
      console.log("montado");
  },
  methods:{
    getUserApi(){
      axios.get('/api/user/',this.headers).
        then(response => {
          this.user= response.data;
          console.log('user');
          console.log(user);
        }).catch(error => {
          console.log(error)
        })
    },  
    postLogin(){
      axios.post('/api/auth/login',{
          password : this.password,
          email : this.email,     
      }).then(response =>{
        console.log(response.data);
        localStorage.access_token = response.data.access_token;
        localStorage.token_type = response.data.token_type;      
      }).catch(error =>{
          // if(error.response.status==500){
          //     console.log(error.response);
          // }          
      });
    }
    
  }
}
 
</script>