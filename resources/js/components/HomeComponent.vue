<template>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="float-left"><h3>Lista de hoteles </h3></div>
					<div class="float-right">
						<div class="btn-group">
						<a href="/create" class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
						</div>
					</div>
					<div class="card-body">
						<table id="mytable" class="table table-bordred table-striped" data-form="ListaForm">
							<thead>
								<th>Nombre</th>
								<th>Dirección</th>
								<th>Ciudad</th>
								<th>NIT</th>
								<th>Numero de Hab</th>
							</thead>
							<tbody>
                                <tr v-for="datosHoteles in datos_hoteles">
                                    <td>{{ datosHoteles.nombre_ho }}</td>
                                    <td>{{ datosHoteles.direccion_ho }}</td>
                                    <td>{{ datosHoteles['ciudad'][0].nom_ciudad }}</td>
                                    <td>{{ datosHoteles.nit }}</td>
                                    <td>{{ datosHoteles.numero_habit }}</td>
                                    <td>
                                        <router-link :to="{name: 'create', params: { id: datosHoteles.id_hotel }}" class="btn btn-primary"><span class="fa fa-pencil"></span></router-link>
                                    </td>
									<td>
										<button @click.prevent="confirmRemove(datosHoteles.id_hotel,datosHoteles.nombre_ho)" class="btn btn-danger btn-xs" type="button"><span class="fa fa-trash"></span></button>
                                    </td>
                                </tr>
                                <tr v-if="datos_hoteles.length == 0">
									<td colspan="7">No hay registro de productos !!</td>
								</tr>
							</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                datos_hoteles:[]
            }
        },
        created() {
            var app = this;
            let loader = this.loading();
            let uri = 'https://hotelesdecameronweb.herokuapp.com/api/hotel';
            this.axios.get(uri).then(response => {
                this.datos_hoteles = response.data.data;
                loader.hide();
            });
        },
        methods: {
            loading(){
                var app = this;
                let loader = app.$loading.show({
                // Optional parameters
                container: app.fullPage ? null : app.$refs.formContainer,
                canCancel: false,
                onCancel: app.onCancel,
                });
                return loader;
            },
            confirmRemove(id,nombreHotel){
                let element = this; 
                this.$dialog.confirm('Esta seguro de eliminar el Hotel '+nombreHotel+'?',{
                    loader: true
                })
                .then((dialog) => {
                    // Triggered when proceed button is clicked
            
                    // dialog.loading(false) // stops the proceed button's loader
                    // dialog.loading(true) // starts the proceed button's loader again
                    // dialog.close() // stops the loader and close the dialog
            
                    // do some stuff like ajax request.
                    setTimeout(() => {
                        element.removeHotel(id);
                        dialog.close();
                    }, 2500);
            
                })
                .catch(() => {
                    // Triggered when cancel button is clicked
                    console.log('Delete aborted');
                });
            },
            removeHotel(id){
                let loader = this.loading();
                let uri_delete = `https://hotelesdecameronweb.herokuapp.com/api/hotel/${id}`;
                this.axios.delete(uri_delete).then(response => {
                    this.datos_hoteles.splice(this.datos_hoteles.indexOf(id), 1);
                    loader.hide();
                });
            }
        }
    }
</script>