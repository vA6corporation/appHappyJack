<template lang="html">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between">
        <h1>Lista de Equipos</h1>
        <div class="">
          <router-link class="btn btn-info" to='/machine/create'>Nueva Maquina
            <i data-feather='plus'></i>
          </router-link>
        </div>
      </div>
      <hr>
    </div>
    <div class="col-12" v-for='room in rooms'>
      <h3>{{ room.name }}</h3>
      <table class="table table-bordered table-sm">
        <thead>
          <th>Nombre del equipo</th>
          <th>Nombre del juego</th>
          <th>Denominacion</th>
          <th>Fabricante</th>
          <th>Serie</th>
          <th>Posicion</th>
          <th>Numero</th>
          <th>Observacion</th>
          <th>Opciones</th>
        </thead>
        <tbody class="text-capitalize">
          <tr v-for='(item, index) in room.machines'>
            <td>{{ item.name }}</td>
            <td>{{ item.game }}</td>
            <td>{{ item.denominate }}</td>
            <td>{{ item.maker }}</td>
            <td>{{ item.series }}</td>
            <td>{{ item.position }}</td>
            <td>{{ item.number }}</td>
            <td v-if='item.observation'>{{ item.observation }}</td>
            <td v-else>Sin observacion</td>
            <td>
              <router-link :to="{ path: `machine/${item.id}/edit` }">Editar</router-link>
              <span> | </span>
              <router-link :to="{ path: `machine/${item.id}/delete` }">Eliminar</router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.fetchData();
  },
  data() {
    return {
      machines: [],
      rooms: [],
    }
  },
  methods: {
    fetchData() {
      this.$http.get('rooms/allWithMachines').then(response => {
        console.log(response);
        this.rooms = response.body.rooms;
      });
      this.$http.get('machines/withoutRoom').then(response => {
        console.log(response);
        this.rooms.push({ name: 'Sin sala', machines: response.body.machines });
      });
    },
    remove: function(id) {
      this.$http.delete('machines/');
    }
  }
}
</script>

<style lang="css">
</style>
