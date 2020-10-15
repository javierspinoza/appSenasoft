
<template>
    <main class="main">
        <ol class="breadcrumb">
            <i class="fa-fa-book">Home</i>
        </ol>
        <div class="container-fluid">
            <div class="card">                
                <div class="card-header">
                    <button type="button" class="btn btn-primary" data.toggle="modal" @click="abrirModal('guardar')">
                        <i class="icon-plus"></i>&nbsp;Agregar
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm" >
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Nombre empresa</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="objeto in arrayDatos" :key="objeto.id">
                                <td v-text="objeto.nombre"></td>
                                <td v-text="objeto.direccion"></td>
                                <td v-text="objeto.nomTenan"></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data.toggle="modal" @click="abrirModal('editar',objeto)">
                                        <i class="icon-pencil"></i>
                                    </button>&nbsp;
                                    <button type="button" class="btn btn-danger btn-sm" data.toggle="modal" @click="eliminarSur('objeto')">
                                        <i class="icon-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalNuevo" :class="{'mostrar' :modal}">
            <div class="modal-dialog modal-primary modal-lg" role="document">            
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-tittle " v-text="titulo"></h4>
                        <button type="button" class="close" @click="cerrarModal">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="input-text">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" id="nombre" name="nombre" class="form-control" placeholder="ingrese su nombre" >
                                    <span>Ingrese su nombre</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="input-text">Dirección</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="direccion" id="direccion" name="direccion" class="form-control" placeholder="ingrese su direccion" >
                                    <span>Ingrese su direccion</span>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="input-text">Empresa</label>
                                <div class="col-md-9">
                                    <select class="form-control" v-model="idTenan" id="exampleFormControlSelect1">
                                        <option v-for="objeto in arrayTenan" :key="objeto.id" :value="objeto.id" v-text="objeto.nombre"></option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="cerrarModal" class="btn btn-secondary" data.dismiss="modal">Cerrar</button>
                        <button v-show="accion==0" type="button" @click="regSur" class="btn btn-primary">Guardar</button>
                        <button v-show="accion" type="button" @click="actSur" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
<script>
export default {
    data(){
        return{
            arrayDatos:[],
            nombre: "",
            direccion:"",            
            idSur: 0,
            modal: 0,
            accion: 0,
            titulo: "",
            buscar: "",
            criterio: 'nombre',
            arrayTenan:[],
            idTenan:0
        }
    },
    methods:{
        listSur(){
            let me = this;
            var url = "/sucursal";
            axios.get(url).then(function(response){
                var respuesta = response.data;
                me.arrayDatos = respuesta.sucursales;
            })
            .catch(function(error){
                console.log(error);
            })
        },
<<<<<<< HEAD
        getTenan(){
=======
        methods: {
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //va a la pagina actual
                me.pagination.current_page = page;
                //envia al metodo para traer los datos
                me.listSu(page,criterio,buscar);
            },
            
            listSu:function(page,criterio,buscar){
                let me = this;
                var url = "/sucursal?page="+ page+ '&criterio='+criterio+ '&buscar='+buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.sucursales;
                    // me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
              getTenan(){
>>>>>>> dayanna
            let me = this;
            var url = "/selecttenan";
            axios.get(url).then(function(response){
                var respuesta = response.data;
                me.arrayTenan = respuesta.tenans;
            })
            .catch(function(error){
                console.log(error);
            })
        },
        regSur(){
            let me = this;
            var url = "/sucursal/registrar";
            axios.post(url,{
                nombre:this.nombre,
                direccion:this.direccion,
                id_tenan:this.idTenan
            })
            .then(function(response){
                alert("se registro correctamente");
                me.listSur();
            })
            .catch(function(error){
                console.log(error);
            })
        },
        actSur(){
            let me = this;
            var url = "/sucursal/actualizar";
            axios.put(url,{
                id:this.idSur,
                nombre:this.nombre,
                direccion:this.direccion,
            })
            .then(function(response){
                alert("se actualizo correctamente");
                me.listSur();
                me.cerrarModal();
            })
            .catch(function(error){
                console.log(error);
            })
        },
        eliminarSur(data=[]){
            let me = this;
            var url = "/sucursal/eliminar";
            axios.post(url,{
                id:data["id"]        
            })
            .then(function(response){
                alert("se elimino correctamente");
                me.listSur();
            })
            .catch(function(error){
                console.log(error);
            })
        },
        abrirModal(accion,data=[]){
            switch (accion) {
                case "guardar":
                    this.titulo = "registrar sucursal";
                    accion = 0;
                    this.limpiar();
                    break;
                case "editar":
                    this.titulo = "editar sucursal";
                    this.accion = 1;
                    this.idSur = data['id'];
                    this.nombre = data['nombre'];
                    this.direccion = data['direccion'];
                    this.id_tenan = data['id_tenan'];
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
            // this.nombre = "";
        }
    },
    mounted(){
        // console.log('component mounted.')
        this.getTenan();
        this.listSur();

        // if(localStorage.cc) this.cc = localStorage.cc;
        // if(localStorage.nombre) this.nombre = localStorage.nombre;
        // if(localStorage.apellidos) this.apellidos = localStorage.apellidos;
        // },
        // watch:{
        //     cc(newCc) {
        //     localStorage.cc = newCc;
        //     },
        //     nombre(newName) {
        //     localStorage.nombre = newName;
        //     },
        //     apellidos(newSurname) {
        //     localStorage.apellidos = newSurname;
        //     }
        } 
}
</script>
<style>
    .modal-content{
       width: 100% !important;
       position: absolute !important;
    }
    .mostrar{
       display: list-item !important;
       opacity: 1 !important;
       position: absolute !important;
    }
</style>