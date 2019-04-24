<template>
    <div class="container">
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item-active" v-if="user.razon_social.length !== 0" >
           <a class="nav-link" href="#"  @click.stop='logout()'>Bienvenid@ {{ user.razon_social }}<span class="sr-only">(current)</span>
           </a>
         <li class="nav-item-active" v-if="user.razon_social.length !== 0" >
          </a>
          <a class="nav-link" href="#"  @click.stop='logout()'>Cerrar Sesion <span class="sr-only">(current)</span>
          </a>
        </li>
        <li style="padding-right: 200px;" class="nav-item-active dropdown"  v-if="user.razon_social.length === 0">
          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
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
          </li>
      </ul>
      
    </div>
</template>

<script>
export default {
  data () {
      return {  
          user: {razon_social:''},
          access_token: 0,
          token_type: '',        
          email: '',
          password: '',
          config:{},
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
     
  },
  created:function(){
  
  
  },
  methods:{
    getUserApi(){     
      axios.get('/api/user/',this.config).
        then(response => {
          this.user= response.data;
          console.log('user');
          console.log(this.user);
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
        location.reload();     
      }).catch(error =>{
          // if(error.response.status==500){
          //     console.log(error.response);
          // }          
      });
    },
    logout(){
      axios.post('/api/auth/logout',{
        
      },this.config).then(response =>{
        localStorage.access_token = '';
        localStorage.token_type = '';
        location.reload();    
       
      }).catch(error =>{
                   
      });
    }
    
  }
}
</script>