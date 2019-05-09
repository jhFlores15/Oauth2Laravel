<template>
    <div class="container">
      <div  id="" class="justify-content-center text-center" >
        <br>
        <h4 class="text-center">Encuestando a {{ cliente.razon_social }}</h4>
         <br> <br>
        <form>
          <div class="form-group">
            <label >Fecha de Nacimiento</label>
            <input type="date" class="form-control" v-model="encuesta_cliente.cumpleaños" placeholder="">
            <div class="alert alert-danger"  v-if="erroresEncuesta.cumpleaños"  role="alert">
              {{ erroresEncuesta.cumpleaños[0] }}
            </div>
          </div>
          <div class="form-group">
            <label >Telefono(s)</label>
            <input type="text" class="form-control" v-model="encuesta_cliente.telefono" placeholder="">
          </div>
          <div class="alert alert-danger"  v-if="erroresEncuesta.telefono" role="alert">
               {{ erroresEncuesta.telefono[0] }}
            </div>
          <div class="form-group">
            <label >Email</label>
            <input type="email" class="form-control"   v-model="encuesta_cliente.email" placeholder="example@example.com">
          </div>  
          <div class="alert alert-danger" role="alert" v-if="erroresEncuesta.email" >
             {{ erroresEncuesta.email[0] }}
            </div>        
          <button type="button" @click.stop="putGuardar()" class="btn btn-primary">Guardar</button>
        </form>
  

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
          encuesta_cliente:{
            cumpleaños:'',
            email:'',
            telefono:'',
          },
          erroresEncuesta:{
            cumpleaños:'',
            email:'',
            telefono:'',
          },
      }
  },
  
  mounted() {   
  console.log(this.cliente_id);

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
      this.getEncuestaCliente();        
    }
     
  },
  created:function(){
  
  
  },
  methods:{
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
      getEncuestaCliente(){
        axios.get('/api/encuestas/clientes/'+this.encuesta_id+'/'+this.cliente_id,this.config).
          then(response => {
            this.encuesta_cliente= response.data[0];
          }).catch(error => {
            console.log(error)
          })
      },
      putGuardar(){
        this.erroresEncuesta = [];
        axios.put('/api/encuestas/clientes/'+this.encuesta_id+'/'+this.cliente_id,{          
          'cumpleaños' : this.encuesta_cliente.cumpleaños,
          'email' : this.encuesta_cliente.email,
          'telefono' : this.encuesta_cliente.telefono,          
        },this.config).then(response =>{
          var notification = alertify.notify('Guardado', 'success', 3, function(){  console.log('Guardado Exitoso'); });
           
        }).catch(error =>{
                if(error.response.status = 422){
                    this.erroresEncuesta = error.response.data.error;
                }
                var notification = alertify.notify('Error', 'error', 3, function(){  console.log('Error'); });
          
        });
      }


    
  }
}
</script>