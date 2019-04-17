<template>

    <div class="container">
     <!--- <div v-if="user.name.length != 0">
           
      </div> -->
      <div class="row" v-if="user.name.length == 0">
        <div class="col-sm">
          <button type="button" class="btn btn-primary">Registro</button>
        </div>
        <div class="col-sm">
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
       
      </div>
      <button type="button" @click.stop='getUserApi()'  class="btn btn-primary ">getUser</button>
    </div>
</template>
<script>
export default {
  data () {
      return {  
          user: {name:''},
          access_token: 0,
          token_type: '',        
          email: '',
          password: '',
          // config : {
          //   headers: {
          //    'Content-Type': 'application/json' ,
          //    'Authorization':this.token_type + " " + this.access_token,
          //   },
          // },  
          config:{},
      }
  },
  
  mounted() {    
    console.log('montado');
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
  //  if (localStorage.access_token){        
  //       this.access_token = localStorage.access_token;
  //       this.token_type = localStorage.token_type;
  //       let config = {
  //         headers: {
  //          'Content-Type': 'application/json' ,
  //          'Authorization':this.token_type + " " + this.access_token,
  //         },
  //       }; 
  //       this.config = config;     
  //       this.getUserApi();    
  // }
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
    }
    
  }
}
 
</script>