<template lang="html">
  <nav class="col-2 mt-3 d-none d-lg-block bg-light sidebar bg-dark text-white position-fixed shadow">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <!-- <router-link :to="{ name: 'orderlist', params: {} }"> -->
          <router-link class="nav-link" to="/sales/create">
            <i data-feather='monitor'></i> Punto de Venta
          </router-link>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseCustomer">
            <i data-feather='users'></i> Clientes
          </a>
          <div class="collapse pl-3" id='collapseCustomer'>
            <router-link class="nav-link" to="/customers">Clientes</router-link>
            <router-link class="nav-link" to="/businesses">Empresas</router-link>
            <router-link class="nav-link" to="/jobs">Cargos/Puestos</router-link>
          </div>
        </li>
      </ul>
      <!-- <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('sales.create') }}">
            <i data-feather='monitor'></i> Punto de Venta
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseCustomer">
            <i data-feather='users'></i> Clientes
          </a>
          <div class="collapse pl-3" id='collapseCustomer'>
            <a class="nav-link" href="{{route('customers.index')}}">Trabajadores</a>
            <a class="nav-link" href="{{route('businesses.index')}}">Empresas</a>
            <a class="nav-link" href="{{route('jobs.index')}}">Cargos/Puestos</a>
          </div>
        </li>
      </ul> -->
    </div>
  </nav>
</template>

<script>
export default {
}
</script>

<style lang="css">
</style>
