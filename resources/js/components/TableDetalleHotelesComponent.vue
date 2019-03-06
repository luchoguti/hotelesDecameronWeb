<template>
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">Cantidad</th>
            <th scope="col">Tipo Habitación</th>
            <th scope="col">Tipo Acomodación</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(detalleHabAcom, index) in proplabels">
                <td><input type="text" class="form-control" v-model="detalleHabAcom.cantidad" disabled></td>
                <td><input type="text" class="form-control" v-model="detalleHabAcom.tipoHab_descrip" disabled></td>
                <td><input type="text" class="form-control" v-model="detalleHabAcom.tipoAcomd" disabled></td>
                <td>
                    <button type="button" class="btn btn-outline-danger btn-sm" @click="deleteEvent(index)">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
</template>

<script>
  export default {
    props:['proplabels'],
    data() {
        return{
            disabled: true,
        }
    },
    methods:{
        deleteEvent: function(index) {
            this.proplabels.splice(index, 1);
        }
    },
  }
</script>
