<template>
	<div class="container-fluid">
		<div  id="" class="justify-content-center text-center" >
        	<br>
        	<h4 class="text-center">Clientes</h4>
         	<br>
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-light mb-3" style="width: auto;">
                      <div class="card-header">Clientes Activos</div>
                      <div class="card-body">
                         <form>
                              <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Subir Datos</label>
                                <div class="col-sm-9">
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <img src="https://img.icons8.com/color/40/000000/ms-excel.png"></div>
                                    <b-form-file require accept=".csv,.xlsx"  type="file" id="file" ref="file"  v-on:change="selectedFileActivos($event)" placeholder="Escoge un archivo..." v-model="subirActivosfile"></b-form-file>
                                    <div v-if="loaderActivos == false">
                                         <button type="button"  @click.stop="postActivos()" class="btn btn-outline-success mb-2">Subir Datos</button>
                                    </div>
                                    <div v-else class="loader"></div>   
                                    
                                    </div>
                                    <table class="table table-bordered table-sm text-center">
                                        <thead>
                                          <tr>
                                           <th>codigo</th>
                                            <th>rut</th>
                                            <th>dv</th>
                                            <th>razon_social</th>
                                            <th>direccion</th>
                                            <th>comuna</th>
                                            <th>cod_vendedor</th>
                                          </tr>
                                        </thead>                
                                    </table>
                                </div>
                              </div>
                             <div class="form-group row text-center">
                                <label for="inputPassword" class="col-sm-2 col-form-label ">Descargar Datos</label>
                                <div class="col-sm-4">
                                   <div class="col-sm-4">
                                        <div v-if="loaderDescargar== false">
                                             <button type="button" @click.stop="exportActivos()" class="btn btn-link">
                                                <img src="https://img.icons8.com/dusk/40/000000/database-export.png">
                                            </button>
                                        </div>
                                        <div v-else class="loader"></div>                                 
                                    </div>                                
                                </div>
                              </div>
                            </form>
                         </div>
                    </div>
                </div>
                 <div class="col-md-6 ">
                     <div class="card bg-light mb-3" style="width: auto;">
                      <div class="card-header"> Eliminar Datos </div>
                      <div class="card-body">
                             <form>
                              <label>Recuerde que debe eliminar toda la informacion si desea actualizar los clientes del sistema. (Se eliminaran todos los clientes y las encuestas con su informacion)</label>
                              <div class="form-group row text-center">
                                <label for="inputPassword" class="col-sm-2 col-form-label ">&nbsp;</label>
                                <div class="col-sm-4">
                                    <div v-if="loaderDelete == false">
                                         <button type="button" @click.stop="showModalDelete()" class="btn btn-link">
                                           <img src="https://img.icons8.com/flat_round/40/000000/delete-sign.png">
                                        </button>
                                    </div>
                                    <div v-else class="loader"></div>                                 
                                </div>
                              </div>
                            </form>
                      </div>
                    </div>
                </div>
            </div>
           
     	</div>
       <b-modal ref="modalDelete" id="modalDelete" @ok="deleteAll">
          <p><img src="https://img.icons8.com/color/48/000000/warning-shield.png"><b>Eliminacion</b></p>
          ¿Esta Seguro de Eliminar a Todos los Clientes y Todas las Encuestas y su Informacion?
          <!--  <label visible:=false value=""></label>   -->
        </b-modal>
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
          subirActivosfile:'',
          loaderActivos:false,
          loaderDelete:false,
          loaderDescargar:false,
      }
  },
   mounted() {   
    if (localStorage.access_token){        
      this.access_token = localStorage.access_token;
      this.token_type = localStorage.token_type;
      let config = {
        headers: {
            'Content-Type': 'multipart/form-data' ,
            'Authorization':this.token_type + " " + this.access_token,
        },
      }; 
      this.config = config; 
        this.getUserApi();
    }
     else{
      location.href = '/';
    }     
  },
  methods:{
    showModalDelete(button){
      this.$root.$emit('bv::show::modal', 'modalDelete', button);
    },
    deleteAll(){
        this.loaderDelete = true;
        axios.delete('/api/clientes',this.config).
            then(resp => {
              this.loaderDelete = false;
                if(resp.data == 'ok'){
                  alertify.set('notifier','position', 'top-right');
                  alertify.notify('Datos Eliminados Exitosamente', 'success', 3, function(){  console.log(); });
                }               
            }).catch(error => {
              this.loaderDelete = false;
                alertify.set('notifier','position', 'top-right');
                alertify.notify('Error', 'error', 3, function(){  console.log(); });
            })
   
      
    },
   getUserApi(){       
      axios.get('/api/user/',this.config).
        then(response => {
          var user = response.data;
          if(user.rol_id != 1 ){
            location.href = '/';
          } 
        }).catch(error => {
         
        })
    },
    selectedFileActivos(event) {
      this.subirActivosfile = event.target.files[0];
    },
     selectedFileInactivos(event) {
      this.subirInactivosfile = event.target.files[0];
    },
    postActivos(){
        if(this.subirActivosfile){
            this.loaderActivos = true;
            let formData = new FormData();            
            formData.append('archivo_activos', this.subirActivosfile);
            axios.post('/api/clientes/activos',formData,this.config)              
            .then(resp =>{
                this.loaderActivos = false;
                if(resp.data == 'ok'){
                  alertify.set('notifier','position', 'top-right');
                  alertify.notify('Clientes Registrados Exitosamente', 'success', 3, function(){  console.log(); });
                }    
            }).catch(error =>{
                this.loaderActivos = false;
                alertify.set('notifier','position', 'top-right');
                alertify.notify(error.response.data.message, 'error', 10, function(){  console.log(); });
            });
        }        
    },
    exportActivos(){
      this.loaderDescargar = true;
         axios.get('/api/clientes/activos/export',this.config).
            then(resp => {
              this.loaderDescargar = false;
                if(resp.data == 'ok'){
                    console.log('meme');
                    window.open('/excel/down','_blank'); 
                }
                else if(resp.data == 'fail'){
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('No hay datos que exportar', 'error', 3, function(){  console.log(); });
                }
            }).catch(error => {
              this.loaderDescargar = false;
             
            })
    },

    
  }
}
</script>
