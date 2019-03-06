<template>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
      <div class="alert alert-danger alert-dismissible fade show" v-if="errors.length" v-for="error in errors" role="alert">
        {{error}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="alert alert-success alert-dismissible fade show" v-if="msgsResponseAction.length" v-for="msgResponseAction in msgsResponseAction" role="alert">
        {{msgResponseAction}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
			<div class="card">
				<div class="card-header">
					<div class="float-left" v-if="typeof this.paramId === 'undefined' "><h3>Nuevo Hotel</h3></div>
					<div class="float-left" v-if="typeof this.paramId !== 'undefined' "><h3>Edición Hotel</h3></div>	
				</div>
				<div class="card-body">
					<form @submit.prevent="requestHotel">
           <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
              <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" v-model="hotel.nombre" class="form-control input-sm" placeholder="">
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
              <div class="form-group">
                <label for="nombre">Dirección:</label>
                <input type="text" v-model="hotel.direccion" class="form-control input-sm" placeholder="">
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
              <div class="form-group">
                <label for="nombre">Ciudad:</label>
                <select  class="custom-select input-sm" id="ciudad" v-model="hotel.ciudad">
                  <option value="">Seleccione una Ciudad</option>
                  <option v-for="ciudad in ciudades" :value="ciudad.id_ciudad"> {{ ciudad.nom_ciudad }} </option>
                </select>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
              <div class="form-group">
                <label for="nombre">NIT:</label>
                <input type="number" v-model="hotel.nit" class="form-control input-sm" placeholder="">
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
              <div class="form-group">
                <label for="nombre">Numero de Hab:</label>
                <input type="number" v-model="hotel.num_hab" class="form-control input-sm" placeholder="">
              </div>
            </div>
          </div>
          <hr>
          <div class="alert alert-success alert-dismissible fade show" v-if="msgs.length" v-for="msg in msgs" role="alert">
            {{msg}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
              <div class="form-group">
                <input type="number" v-model="hotel_detalle.cantidad" class="form-control input-sm" placeholder="Cantidad">
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
              <div class="form-group">
                <select class="form-control input-sm" v-model="hotel_detalle.tipoHab" @change="onChangeTipoHab($event)">
                  <option value="">Tipo Habitación</option>
                  <option v-for="tipoHabit in tipoHab" :value="tipoHabit.id_tipo_hab"> {{ tipoHabit.descripcion_tipo_hab }} </option>
                </select>
              </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
              <div class="form-group">
                <select class="form-control input-sm" v-model="hotel_detalle.tipoAcomd" @change="onChangeTipoAcomd($event)">
                  <option value="">Tipo Acomodación</option>
                  <option v-for="habAcomodacion in habAcomd" :data-id="habAcomodacion.id_tipo_hab_acomd" :value="habAcomodacion['acomodacion'][0].descripcion_tipo_acom"> {{ habAcomodacion['acomodacion'][0].descripcion_tipo_acom }} </option>
                </select>
                <input type="hidden" v-model="this.hotel_detalle.hab_acomd">
              </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1">
                <a href="#" class="btn btn-info" v-on:click.prevent="addRow" ><i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
            <charttable v-bind:proplabels="labels" />
          </div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<button type="submit" v-if="typeof this.paramId === 'undefined' " class="btn btn-success btn-block">Guardar</button>
						<button type="submit" v-if="typeof this.paramId !== 'undefined' " class="btn btn-success btn-block">Actualizar</button>
						<a href="/" class="btn btn-info btn-block">Atrás</a>
					</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
  import charttable from './TableDetalleHotelesComponent.vue';

  export default {
    data(){
      return {
        dataid:'',
        hotel:{},
        hotel_detalle:{},
        ciudades:[],
        tipoHab:[],
        habAcomd:[],
        labels: [],
        errors: [],
        msgsResponseAction:[],
        msgs:[],
        paramId:''
      }
    },
    created() {
      let loader = this.loading();
      this.hotel.ciudad = '';
      let uri = 'https://hotelesdecameronweb.herokuapp.com/api/ciudades';
      this.axios.get(uri).then(async response => {
         this.ciudades = await response.data.data;
      });
      this.paramId=this.$route.params.id;
      if (typeof this.paramId !== "undefined") {
        let uriParam = `https://hotelesdecameronweb.herokuapp.com/api/hotel/${this.paramId}`;
        this.axios.get(uriParam).then(async (response) => {
           let objResp= await response.data.data;
           this.hotel.nombre = objResp[0].nombre_ho;
           this.hotel.direccion = objResp[0].direccion_ho;
           this.hotel.ciudad = objResp[0]['ciudad'][0].id_ciudad;
           this.hotel.nit = objResp[0].nit;
           this.hotel.num_hab = objResp[0].numero_habit;
           let hotelDetalle = objResp[0].hotel_descrip_detalle;
           let element = this;
           hotelDetalle.forEach(function (datosHot,key) {
              element.labels.push({
                cantidad:datosHot.numero_hoteles_habit,
                hab_acomd:datosHot.hab_acomd[0].id_tipo_hab_acomd,
                tipoHab:datosHot.hab_acomd[0].id_tipo_hab,
                tipoHab_descrip:datosHot.hab_acomd[0].habitacion[0].descripcion_tipo_hab,
                tipoAcomd:datosHot.hab_acomd[0].acomodacion[0].descripcion_tipo_acom
              });
           });
        });
      }
      this.resetObj();
      let uri_tipoHab = 'https://hotelesdecameronweb.herokuapp.com/api/tipoHabitacion';
      this.axios.get(uri_tipoHab).then(response => {
        this.tipoHab = response.data.data;
      });
      loader.hide();
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
      resetObj(){
        this.hotel_detalle.tipoAcomd = '';
        this.hotel_detalle.tipoHab = '';
      },
      validateFormHotel(){
        this.errors = [];
        if (!this.hotel.nombre) {
          this.errors.push('Nombre es requerido.');
        }
        if (!this.hotel.direccion) {
          this.errors.push('Dirección es requerido.');
        }
        if (!this.hotel.nit) {
          this.errors.push('NIT es requerido.');
        }
        if (!this.hotel.num_hab) {
          this.errors.push('Num de Hab es requerido.');
        }
        if (this.labels.length == 0){
            this.errors.push('Debe haber al menos una espeficación de tipo habitación y acomodación.');
        }
      },
      toObject(arr) {
        var rv = {};
        for (var i = 0; i < arr.length; ++i){
          if (arr[i] !== undefined){
             rv[i] = arr[i];
          }
          if(Array.isArray(arr[i])){
            rv[i] = Object.assign({},arr[i]);
          }
        }
        return rv;
      },
      updateHotel(){
        if (!this.errors.length){
          $("html, body").animate({ scrollTop: 0 }, "slow");
          let loader = this.loading();
          let uri = `https://hotelesdecameronweb.herokuapp.com/api/hotel/${this.paramId}`;
          let datosPost = {hotel_info_basica:this.hotel,hotel_info_detall:this.toObject(this.labels)};
          this.axios.put(uri, datosPost).then((response) => {
            this.msgsResponseAction.push(response.data.message);
            setTimeout(() => {
              loader.hide();
              this.$router.push('/');
            }, 2500);
          }).catch((error) => {
             loader.hide();
             this.errors = [];
             let msgs=Object.values(JSON.parse(error.response.data.message));
             let errors = this.errors;
             msgs.forEach(function (datosMsg,key) {
                errors.push(datosMsg);
             });
          });
        }else{
          $("html, body").animate({ scrollTop: 0 }, "slow");
        }
      },
      addNewHotel(){
        if (!this.errors.length){
          $("html, body").animate({ scrollTop: 0 }, "slow");
          let loader = this.loading();
          let uri = `https://hotelesdecameronweb.herokuapp.com/api/hotel`;
          let datosPost = {hotel_info_basica:this.hotel,hotel_info_detall:this.toObject(this.labels)};
          this.axios.post(uri, datosPost).then((response) => {
            this.msgsResponseAction.push(response.data.message);
            setTimeout(() => {
              loader.hide();
              this.$router.push('/');
            }, 2500);
          }).catch((error) => {
             loader.hide();
             this.errors = [];
             let msgs=Object.values(JSON.parse(error.response.data.message));
             let errors = this.errors;
             msgs.forEach(function (datosMsg,key) {
                errors.push(datosMsg);
             });
          });
        }else{
          $("html, body").animate({ scrollTop: 0 }, "slow");
        }
      },
      requestHotel(){
        this.validateFormHotel();
        if (typeof this.paramId !== "undefined") {
          this.updateHotel();
        }else{
          this.addNewHotel();
        }
      },
      addRow: function (event) {
        this.validateFormDetalle();
        if (!this.errors.length){
          this.labels.push(this.hotel_detalle);
          this.hotel_detalle = [];
          this.resetObj();
        }else{
          $("html, body").animate({ scrollTop: 0 }, "slow");
        }
      },
      validateFormDetalle(){
        this.errors = [];
        if (!this.hotel_detalle.cantidad) {
          this.errors.push('Cantidad es requerido.');
        }
        if (!this.hotel_detalle.tipoHab) {
          this.errors.push('Tipo de Habitacion es requerido.');
        }
        if (!this.hotel_detalle.tipoAcomd) {
          this.errors.push('Tipo de Acomodación es requerido.');
        }
        if (!this.hotel.num_hab) {
          this.errors.push('Numero de Hab es requerido.');
        }
        if (parseInt(this.hotel.num_hab) < parseInt(this.hotel_detalle.cantidad) ) {
          this.errors.push('Cantidad no puede ser mayor a Numero de Hab valide.');
        }
        if (this.labels.length){
          let cant_total_hot_det = 0;
          this.labels.forEach(function (datos,key) {
              cant_total_hot_det += parseInt(datos.cantidad);
          });
          cant_total_hot_det += parseInt(this.hotel_detalle.cantidad);
          if (parseInt(this.hotel.num_hab) < cant_total_hot_det) {
            this.errors.push('Cantidad Total es mayor a Numero de Hab valide.');
          }
        }
      },
      filterTipoAcomod(queryObj,idHab){
        if (this.labels.length){
          let validPas = 0;
          let newObjAcomd = queryObj;
          this.labels.forEach(function (datos,key) {
              let acomodacion = datos.tipoAcomd;
              if(datos.tipoHab == idHab){
                newObjAcomd= newObjAcomd.filter(function(el) {
                  return el['acomodacion'][0].descripcion_tipo_acom != acomodacion;
                });
                validPas = 1;
              }
          });
          if(validPas==0){
            return queryObj;
          }else{
            this.msgs = [];
            if(newObjAcomd.length == 0){
              this.msgs.push('Se ingresaron todos los tipos de acomodaciones disponibles, Seleccione otro tipo de habitación.');
            }
            return newObjAcomd;
          }
        }else{
          return queryObj;
        }
      },
      onChangeTipoHab: function (event) {
        let loader = this.loading();
        this.errors = [];
        if (this.hotel_detalle.tipoHab == '') {
          this.errors.push('Tipo de Habitacion Requerido.');
        }
        if (this.errors.length == 0){
          let id_hab = event.target.value;
          let uri_habAcomd = 'https://hotelesdecameronweb.herokuapp.com/api/habitAcomd?id_tipo_hab='+id_hab;
          this.axios.get(uri_habAcomd).then(response => {
            this.hotel_detalle.tipoHab_descrip =  this.tipoHab.find(objTiHab => objTiHab.id_tipo_hab == id_hab).descripcion_tipo_hab;
            this.habAcomd = this.filterTipoAcomod(response.data.data,id_hab);
          });
        }
        loader.hide();
      },
      onChangeTipoAcomd: function (event) {
        const theTarget = event.target.options[event.target.options.selectedIndex].dataset;
        this.hotel_detalle.hab_acomd = theTarget.id;
      },
    },
    components: {
      charttable: charttable
    },
  }
</script>