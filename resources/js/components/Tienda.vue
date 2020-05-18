<template>
    <div>                
        <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#crearTienda">
            Nueva tienda
            <i class="far fa-building"></i>
        </a><br><br>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Productos</th>
                    <th>Nombre</th>
                    <th>Fecha de apertura</th>
                    <th colspan="2">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for='tienda in tiendas' :key="tienda.id">
                    <td width="10px">{{ tienda.id }}</td>
                    <td width="10px" align="center">
                        <a class="btn btn-primary btn-sm" title="Productos" v-on:click.prevent="productos(tienda.id)">
                            <i class="fas fa-box-open"></i>
                        </a>
                    </td>
                    <td>{{ tienda.nombre }}</td>
                    <td>{{ tienda.fecha_apertura }}</td>
                    <td width="10px">
                        <a class="btn btn-warning btn-sm" title="Editar" v-on:click.prevent="editTienda(tienda)">
                            <i class="far fa-edit"></i>
                        </a>
                    </td>
                    <td width="10px">
                        <a class="btn btn-danger btn-sm" title="Eliminar" v-on:click.prevent="deleteTienda(tienda)">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <nav>
            <ul class="pagination justify-content-end">
                <li class="page-item" v-if='paginate.current_page > 1'>
                    <a class="page-link" href="#" v-on:click.prevent='changePage(paginate.current_page - 1)'>
                        Anterior
                    </a>
                </li>

                <li class="page-item" v-for='pages in pagesNumber' :key="pages" v-bind:class="[ pages == isActived ? 'active' : '' ]">
                    <a class="page-link" href="#" v-on:click.prevent="changePage(pages)">
                        {{ pages }}
                    </a>
                </li>

                <li class="page-item" v-if='paginate.current_page < paginate.last_page'>
                    <a class="page-link" href="#" v-on:click.prevent='changePage(paginate.current_page + 1)'>
                        Siguiente
                    </a>
                </li>
            </ul>
        </nav>

        <div>         
            <form method="POST" v-on:submit.prevent="updateTienda(fillTienda.id)">            
                <div class="modal fade" id="actualizarTienda">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Editar tienda</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" class="form-control" v-model="fillTienda.nombre">
                                <label for="fecha_apertura">Fecha de apertura</label>
                                <input type="date" name="fecha_apertura" class="form-control" v-model="fillTienda.fecha_apertura">
                                <span v-for="error in errors" :key="error" class="text-danger">{{ error }}</span>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" value="Actualizar">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import EventBus from '../event-bus';
    export default {
        data() {
            return{
                tiendas: [],
                paginate: {
                    total:0,
                    current_page:0,
                    per_page:0,
                    last_page:0,
                    from:0,
                    to:0
                },
                newTarea:{'nombre':'', 'fecha_apertura':''},
                fillTienda:{ 'id':'', 'nombre':'', 'fecha_apertura':''},
                errors: [],                
                offset: 3
            }                 
        },        

        created: function(){
            this.getTareas();
        },

        mounted: function() {
            let self = this;
            EventBus.$on('event.getTareas', function(){
                self.getTareas();
            });
        },

        computed: {
            isActived: function(){
                return this.paginate.current_page;
            },
            pagesNumber: function(){

                if(!this.paginate.to){
                    return [];
                }

                var from = this.paginate.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.paginate.last_page){
                    to = this.paginate.last_page;
                }

                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            getTareas: function(page){
                var urlTienda = 'lstienda?page=' + page;
                axios.get(urlTienda).then(response => {
                    this.tiendas = response.data.tiendas.data;
                    this.paginate = response.data.paginate;
                });
            },
            
            editTienda: function(tienda){
                this.fillTienda.id = tienda.id;
                this.fillTienda.nombre = tienda.nombre;                
                this.fillTienda.fecha_apertura = tienda.fecha_apertura;
                $('#actualizarTienda').modal('show');
            },

            updateTienda: function(id){
                var url = 'tiendas/' + id;
                axios.put(url, this.fillTienda).then(response => {
                    this.getTareas(); 
                    this.fillTienda = { 'id':'', 'nombre':'', 'fecha_apertura':''};
                    this.errors = [];
                    $('#actualizarTienda').modal('hide');
                    toastr.success('Item actualizado correctamente');
                }).catch(error => {
                    this.errors = error.response.data
                });
            },

            deleteTienda: function(tienda){
                var url = 'tiendas/' + tienda.id;
                axios.delete(url).then(response => {
                    this.getTareas();
                    toastr.success('Eliminado correctamente');
                });
            },

            changePage: function(page){
                this.paginate.current_page = page;
                this.getTareas(page);
            },

            productos: function(id){
                
            }           
        }
    }
</script>
