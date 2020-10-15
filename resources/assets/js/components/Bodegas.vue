<template>
    <main class="main" >
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li> 
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>            
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <i class="fa  fa-bookmark"></i> Bodegas
                <button type="button" class="btn btn-primary" data-toggle="modal" @click="abrirModal('guardar')">
                    <i class="icon-plus"></i>&nbsp;Nuevo 
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                              <option value="nombre">Nombre</option>
                            </select>
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>  
                            <th>Sucursales</th>                             
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="objeto in arrayDatos" :key="objeto.id">
                            <td v-text="objeto.nombre"></td>
                                <td v-text="objeto.nomSucur"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" @click="abrirModal('editar', objeto)">
                                  <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" @click="eliminarSu(objeto)">
                                  <i class="icon-trash"></i> 
                                </button>
                            </td>                                                                        
                        </tr>                                                                                                                                
                    </tbody>
                </table>
            <!-- <nav>
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)"
                    >Ant</a>
                    </li>
                    <li
                    class="page-item"
                    v-for="page in pagesNumber"
                    :key="page"
                    :class="[page == isActived ? 'active' : '']"
                    >
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(page,buscar,criterio)"
                    v-text="page"
                    ></a>
                 </li>
                 <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a
                    class="page-link"
                    href="#"
                    @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)"
                    >Sig</a>
                        </li>
                    </ul>
            </nav> -->
            </div>
        </div>
    </div>
    <!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" :class="{'mostrar':modal}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="titulo"></h4>
                    <button type="button" class="close" @click="cerrarModal" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                            <div class="col-md-9">
                                <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="Nombre de la sucursal">
                                <span class="help-block">(*) Seleccione el nombre de la sucursal</span>
                            </div>
                        </div>
                            <div class="form-group row">
                             <label class="col-md-3 form-control-label" for="text-input">Empresa</label>
                                <div class="col-md-9">
                                 <select class="form-control" v-model="id_sucursal" id="exampleFormControlSelect1">
                                    <option v-for="objeto in arraySucursal" :key="objeto.id" :value="objeto.id" v-text="objeto.nombre"></option>
                                </select>
                                <span class="help-block">(*) Seleccione la empresa</span>
                                       </div> 
                        </div>   
                            
                                                   
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal" data-dismiss="modal">Cerrar</button>
                    <button v-show="accion==0" type="button" @click="regBod" class="btn btn-primary">Guardar</button>
                    <button v-show="accion" type="button" @click="actuBod" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
    <!-- Inicio del modal Eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-danger" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar sucursal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Estas seguro de eliminar bodega?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cerrar</button>
                    <button type="button" @click="eliminarSu" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- Fin del modal Eliminar -->
</main>
</template>

<script>
    export default {
        data(){
            return{
                arrayDatos:[],
                nombre:"",
                id_sucursal:0,
                idBod:0,
                modal:0,
                titulo:"",
                accion:0,

                arraySucursal:[],
                id_sucursal:0,
               //variables de pagination
                // pagination:{
                //     total:0,
                //     current_page:0,
                //     su_page:0,
                //     last_page:0,
                //     from:0,
                //     to:0
                // },
                offset:3,
                buscar:'',
                criterio:'nombre'
            }
        },
        methods: {
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //va a la pagina actual
                me.pagination.current_page = page;
                //envia al metodo para traer los datos
                me.listBo(page,criterio,buscar);
            },
            
            listBo:function(page,criterio,buscar){
                let me = this;
                var url = "/bodega?page="+ page+ '&criterio='+criterio+ '&buscar='+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                      me.arrayDatos = respuesta.bodegas;
                    // me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
              getSucur(){
            let me = this;
            var url = "/selectSucur";
            axios.get(url).then(function(response){
                var respuesta = response.data;
                me.arraySucursal = respuesta.sucursales;
            })
            .catch(function(error){
                console.log(error);
            })
        },
            regBod(){
                let me = this;
                var url = "/bodega/registrar";
                axios.post(url,{
                    nombre: this.nombre,
                       id_sucursal:this.id_sucursal,
                })
                .then(function(response){
                    me.mensaje('Se guardo correctamente');  
                    me.listBo();
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });  
            },
            actuBod(){
	                let me = this;
	                var url="/bodega/actualizar";
                    axios.put(url,{
		            id:this.idBod,
                    nombre: this.nombre,
                    id_sucursal:this.id_sucursal,
                })
                .then(function(response){
                    me.listBo();
                    me.mensaje('Se actualizo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            abrirModal(accion,data=[]){
                switch(accion){
                case'guardar':
                this.titulo = 'Registrar bodega';
                this.accion = 0;
                this.limpiar();
             break;
                case 'editar':
                this.titulo = 'Editar bodega';
                this.accion = 1;
                this.idBod = data['id'];
                this.nombre = data['nombre'];      
                this.id_sucursal = data["id"];      
             break;
                default:
                break;
            }
            this.modal = 1;
            },
            cerrarModal(){
              this.modal = 0;
            },
            limpiar(){
              this.nombre ='';
            },
            mensaje(msj){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: msj,
                showConfirmButton: false,
                timer: 2000
            })
            },
             mensaje1(){
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Se elimino correctamente',
                showConfirmButton: false,
                timer: 2000
            })
            },
             eliminarSu(data=[]){
                 let me = this;
             Swal.fire({
                title: '¿Está seguro de eliminarlo?',
                text: "¡No podrás revertir esto!" ,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText:'¡No, cancelar!',
                confirmButtonText: '¡Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                // let me = this;
                var url="/bodega/eliminar";
                axios.post(url,{
                id:data['id']
            })
            .then(function(response){
                me.listBo();
                Swal.fire({
                    title:"¡Se elimino correctamente!",
                    icon: 'success'
                }
             )
             })
            .catch(function(error){
                console.log(error);
            });
            }
            })
            }
        },  
            computed:{
            isActived: function() {
            return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
            }
        },         
         mounted() {
         console.log('Component mounted.')
         this.getSucur();
            this.listBo(1,this.criterio,this.buscar);
         }
  }
</script>
<style>
.modal-content{
width: 100% !important;
position: absolute  !important;;
}
.mostrar{
 display:list-item !important;
 opacity: 1 !important;
 position: absolute !important;
 background-color:#9995957a; 
}
</style>