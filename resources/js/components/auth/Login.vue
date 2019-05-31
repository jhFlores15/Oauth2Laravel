<template>
    <div class="">
       <nav class="navbar navcolor navbar-expand-lg navbar-dark  nav-fill w-100">
          <img class="imgRedondaNavbar" src="https://www.carozzicorp.com/wp-content/themes/carozzi/img/logo_red.png" alt="">
           <a class="navbar-brand" href="#"> &nbsp; &nbsp;Encuestas Carozzi</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="toggle navigation" data-target="#navbarMaster" aria-controls="navbarMaster">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarMaster">
              <div  v-if="user.rol_id === 1">
                 <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item-active">
                    <a class="nav-link" href="/vendedores">Vendedores <span class="sr-only">(current)</span>
                    </a>
                  </li>
                  <li class="nav-item-active">
                    <a class="nav-link" href="/clientes">Clientes <span class="sr-only">(current)</span>
                    </a>
                  </li> 
                  <li class="nav-item-active">
                    <a class="nav-link" href="/administradores">Administradores <span class="sr-only">(current)</span>
                    </a>
                  </li> 
                   <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Encuestas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                       <a class="dropdown-item" href="/encuestas/create">Crear Encuesta <span class="sr-only">(current)</span>
                        </a>
                        <a class="dropdown-item" href="/encuestas">Listado de Encuestas <span class="sr-only">(current)</span>
                        </a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Mantenedores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                       <a class="dropdown-item" href="/regiones">Regiones <span class="sr-only">(current)</span>
                        </a>
                        <a class="dropdown-item" href="/comunas">Comunas <span class="sr-only">(current)</span>
                        </a>                       
                    </div>
                  </li>
                               
                </ul>
              </div>
              <div v-else-if="user.rol_id === 2" >
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                  <li class="nav-item-active">
                    <a class="nav-link" href="/encuestas/vendedor">Listado de Encuestas <span class="sr-only">(current)</span>
                    </a>
                  </li>        
                </ul>
              </div >
               
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item-active" v-if="user.razon_social.length !== 0" >
           <a class="nav-link" href="#">Bienvenid@ {{ user.razon_social }}<span class="sr-only">(current)</span>
           </a>
         <li class="nav-item-active" v-if="user.razon_social.length !== 0" >
          </a>
          <a class="nav-link" href="#"  @click.stop='logout()'>Cerrar Sesion <span class="sr-only">(current)</span>
          </a>
        </li>
        <li style="padding-right: 200px;" class="nav-item-active dropdown"  v-if="user.razon_social.length === 0">
          <button type="button" class="btn navcolor dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><label style="color: white;">Login</label></button>
           <form class="dropdown-menu p-4">        
              <div class="form-group">
                 <label for="dropdown-login">Email</label>
                 <input type="email"  class="form-control" @keyup.enter='postLogin()' placeholder="email@example.com" v-model="email">
              </div>
              <div class="alert alert-danger" v-if="errorLogin.email"role="alert">
                    {{ errorLogin.email[0] }}
                  </div>
              <div class="form-group">
                 <label for="dropdown-login">Password</label>
                 <input type="password"  class="form-control" @keyup.enter='postLogin()' placeholder="Password" v-model="password">
                 <br>
                
                 <div class="alert alert-danger" v-if="errorLogin.password"role="alert">
                    {{ errorLogin.password[0] }}
                  </div>                
              </div>
               <div class="col text-center " v-if="(loading == true)">                
                <div class="loader"  style="margin: auto;"></div>
              </div>
              <div class="col text-center" v-else>
                <button type="button" @click.stop='postLogin()'  class="btn btn-primary "> Aceptar </button>
              </div>
                          
            </form>                 
          </li>
      </ul>
      </div>          
        </nav>
      
    </div>
</template>

<script>
export default {
  data () {
      return {  
          user: {
            razon_social:'',
            rol_id: 0,
          },
          access_token: 0,
          token_type: '',        
          email: '',
          password: '',
          config:{},
          errorLogin:'',
          loading:false,
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
        }).catch(error => {
         
        })
    },  
    postLogin(){
      this.loading = true;
       this.errorLogin = '';
      axios.post('/api/auth/login',{
          password : this.password,
          email : this.email,     
      }).then(response =>{
        this.loading = false;
        alertify.set('notifier','position', 'top-right');
        alertify.notify('Inicio de Sesion Exitoso', 'success', 3, function(){  console.log(); });

        localStorage.access_token = response.data.access_token;
        localStorage.token_type = response.data.token_type; 
        if(response.data.rol_id == 2){
          location.href = '/encuestas/vendedor';
        }
        else{
          location.href = '/clientes'; 
        }
        // location.reload();     
      }).catch(error =>{
        this.loading = false;
          if((error.response.status == 401) && (error.response.data.message == 'Los Datos ingresados no son correctos' )){
              alertify.set('notifier','position', 'top-right');
             alertify.notify('Los Datos ingresados no son correctos', 'error', 3, function(){  console.log(); });  
          } 
          if(error.response.status == 422){
              this.errorLogin = error.response.data.error;
          }        
      });
    },
    logout(){
      axios.post('/api/auth/logout',{        
      },this.config).then(response =>{
        localStorage.access_token = '';
        localStorage.token_type = '';
        alertify.set('notifier','position', 'top-right');
        alertify.notify('ok', 'success', 3, function(){  console.log(); });

        location.href="/";    
       
      }).catch(error =>{
                   
      });
    }
    
  }
}
</script>
