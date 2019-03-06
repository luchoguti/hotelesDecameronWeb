<template>
    <div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-faded mb-4">
          <div class="container">
            <a class="navbar-brand" href="/">
                Hoteles Decameron 
            </a>
          </div>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item" style="width: 6em;">
              <a class="flex-sm-fill text-sm-center nav-link" href="https://hotelesdecameronweb.herokuapp.com/api/hotel">Get Hotel</a>
            </li>
            <li class="nav-item" style="width: 8em;">
              <a class="nav-link" href="https://hotelesdecameronweb.herokuapp.com/api/ciudades">Get Ciudades</a>
            </li>
            <li class="nav-item" style="width: 8em;">
              <a class="nav-link" href="https://hotelesdecameronweb.herokuapp.com/api/tipoHabitacion">Get Tipo Hab.</a>
            </li>
          </ul>
      </nav>
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
</style>

<script>

    export default{
    }
</script>