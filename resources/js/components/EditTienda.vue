<template>
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
                            <label for="referencia">Nombre</label>
                            <input type="text" name="nombre" class="form-control" v-model="fillTienda.nombre">
                            <label for="cantidad">Fecha de apertura</label>
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
</template>

<script>
import EventBus from '../event-bus';
export default {
    data() {
        return {
            fillTienda:{ 'id':'', 'nombre':'', 'fecha_apertura':''},
            errors: []
        }
    },    

    methods:{

        editTienda: function(tarea){
            this.fillTienda.id = tarea.id;
            this.fillTienda.referencia = tarea.nombre;
            this.fillTienda.cantidad = tarea.fecha_apertura;
            $('#actualizarTienda').modal('show');
        },

        updateTienda: function(id){
            var url = 'tiendas/' + id;
            axios.put(url, this.fillTienda).then(response => {
                EventBus.$emit('event.getTareas'); 
                this.fillTienda = { 'id':'', 'nombre':'', 'fecha_apertura':''};
                this.errors = [];
                $('#actualizarTienda').modal('hide');
                toastr.success('Item actualizado correctamente');
            }).catch(error => {
                this.errors = error.response.data
            });
        },
    }
}
</script>