<template> 
    <div>   
        <form method="POST" v-on:submit.prevent="createTienda">            
            <div class="modal fade" id="crearTienda">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Nueva tienda</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control" v-model="newTarea.nombre">
                            <label for="fecha">Fecha de apertura</label>
                            <input type="date" name="fecha_apertura" class="form-control" v-model="newTarea.fecha_apertura">
                            <span v-for="error in errors" :key="error" class="text-danger">{{ error }}</span>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" value="Guardar">
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
    data(){
        return{            
            newTarea:{'nombre':'', 'fecha_apertura':''},
            errors: []
        }        
    },    

    methods:{   

        createTienda: function(){
            var url = 'tiendas';
            axios.post(url, {
                nombre: this.newTarea.nombre,
                fecha_apertura: this.newTarea.fecha_apertura
            }).then(response => { 
                EventBus.$emit('event.getTareas');            
                this.newTarea.nombre = '';
                this.newTarea.fecha_apertura = '';
                this.errors = [];
                $('#crearTienda').modal('hide');
                toastr.success('Nuevo ítem creado con éxito');
            }).catch(error =>{
                this.errors = error.response.data;                
            });
        },
    }
}
</script>