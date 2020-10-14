<template>
    <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb"></ol>
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Entradas
          <button
            type="button"
            @click="mostrarDetalle()"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
          <button type="button" @click="cargarPdf()" class="btn btn-info">
            <i class="icon-doc"></i>&nbsp;Reporte
          </button>
        </div>
        <!-- Listado-->
        <template v-if="listado == 1">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                  <select class="form-control col-md-3" v-model="criterio">
                    <option value="tipo_comprobante">Tipo Comprobante</option>
                    <option value="num_comprobante">Número Comprobante</option>
                    <option value="fecha_hora">Fecha-Hora</option>
                  </select>
                  <input
                    type="text"
                    v-model="buscar"
                    @keyup.enter="listEntrada(1, buscar, criterio)"
                    class="form-control"
                    placeholder="Texto a buscar"
                  />
                  <button
                    type="submit"
                    @click="listEntrada(1, buscar, criterio)"
                    class="btn btn-primary"
                  >
                    <i class="fa fa-search"></i> Buscar
                  </button>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>Opciones</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Nombre sucursal</th>
                    <th>Nombre proveedor</th>                    
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="entrada in arrayEntrada" :key="entrada.id">
                    <td>
                      <button
                        type="button"
                        @click="verEntrada(entrada.id)"
                        class="btn btn-success btn-sm"
                      >
                        <i class="icon-eye"></i>
                      </button>
                      &nbsp;
                      <template v-if="entrada.tipo_comprobante == 'TICKET'">
                        <button
                          type="button"
                          @click="pdfTicket(entrada.id)"
                          class="btn btn-warning btn-sm"
                        >
                          <i class="icon-doc"></i>
                        </button>
                        &nbsp;
                      </template>
                      <template v-else>
                        <button
                          type="button"
                          @click="pdfTicket(venta.id)"
                          class="btn btn-info btn-sm"
                        >
                          <i class="icon-doc"></i>
                        </button>
                        &nbsp;
                      </template>
                      <template v-if="entrada.estado == 'Registrado'">
                        <button
                          type="button"
                          class="btn btn-danger btn-sm"
                          @click="desactivarentrada(venta.id)"
                        >
                          <i class="icon-trash"></i>
                        </button>
                      </template>
                    </td>
                    <td v-text="entrada.fecha"></td>
                    <td v-text="entrada.estado"></td>
                    <td v-text="entrada.total"></td>
                    <td v-text="entrada.id_proveedores"></td>
                    <td v-text="entrada.id_sucursales"></td>
                    <td v-text="entrada.cantidad"></td>
                    <td v-text="entrada.precio"></td>
                    <td v-text="entrada.entradas"></td>
                    <td v-text="entrada.productos"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <nav>
              <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="
                      cambiarPagina(
                        pagination.current_page - 1,
                        buscar,
                        criterio
                      )
                    "
                    >Ant</a
                  >
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
                    @click.prevent="cambiarPagina(page, buscar, criterio)"
                    v-text="page"
                  ></a>
                </li>
                <li
                  class="page-item"
                  v-if="pagination.current_page < pagination.last_page"
                >
                  <a
                    class="page-link"
                    href="#"
                    @click.prevent="
                      cambiarPagina(
                        pagination.current_page + 1,
                        buscar,
                        criterio
                      )
                    "
                    >Sig</a
                  >
                </li>
              </ul>
            </nav>
          </div>        
        <!--Fin Listado-->
        <!-- Detalle-->   
</template>

<script>
    export default {


        data(){
            return{
                arrayDatos:[],
                nombre:'',
                idBod:0,                
                modal:0,
                accion:0,
                titulo:'',
                // variables paguinacion
                pagination:{
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0,
                },
                offset:3,
                buscar:'',
                criterio:'nombre',
            }
        },

        methods: {

            cambiarPagina(page,buscar,criterio){
                let  me = this;
                //va a la pag actual
                me.pagination.current_page= page;
                //envia el metodo para traer los datos
                me.listBod(page,criterio,buscar);
            },

            listBod:function(page,criterio,buscar){
                let me = this;
                var url="/bodega?page="+ page + '&criterio='+criterio +'&buscar='+ buscar;
                axios.get(url).then(function(response){
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.bodegas.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                })
            },
            regBod(){
                let me = this;
                var url="/bodega/registrar";
                axios.post(url,{
                    nombre: this.nombre
                })
                .then(function(response){
                    me.listBod();
                    me.mensaje('Se guardo correctamente');
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            actBod(){
                let me = this;
                var url="/bodega/actualizar";
                axios.put(url,{
                    id:this.idBod,
                    nombre: this.nombre
                })
                .then(function(response){
                    me.listBod();
                    me.mensaje('Se actualizo correctamente');
                    me.cerrarModal();
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            
            eliminarBod(data=[]){
                let me = this;

                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Se eliminaran los datos",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar!',
                    confirmButtonText: 'Confirmar!'
                    }).then((result) => {                        
                    if (result.isConfirmed) {

                        var url="/bodega/eliminar";
                            axios.post(url,{
                            id:data['id']
                        })
                        .then(function(response){
                            me.listBod();
                        })
                            .catch(function(error){
                            console.log(error);
                        });                        
                    }
                })                 
            },
            abrirModal(accion,data=[]){

                switch (accion) {
                    case 'guardar':
                        this.titulo='Registrar bodegas'
                        this.accion=0;
                        this.limpiar();
                        break;
                    case 'editar':
                        this.titulo='Editar bodegas'
                        this.accion=1;
                        this.idBod = data ['id'];
                        this.nombre=data['nombre']
                        break;
                    default:
                        break;
                }
                this.modal=1;
            },
            cerrarModal(){
                this.modal=0;
            },
            limpiar(){
                this.nombre='';
            },
            mensaje(msj){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: msj,
                    showConfirmButton: false,
                    timer: 1500
                })
            },
        },
        computed: {
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
            this.listBod(1,this.criterio,this.buscar);
        }
    }
</script>

<style>

.modal-content{
    width: 100% !important;
    position: absolute;
}

.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: absolute !important;
}

</style>