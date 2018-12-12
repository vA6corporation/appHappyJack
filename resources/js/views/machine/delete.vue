<template lang="html">
  <div class="row">
    <div class="col-12">
      <h1>Eliminar Equipo</h1>
      <hr>
    </div>
    <div class="col-12">
      <div class="form-group">
        <h5>Estas seguro de eliminar el equipo?...</h5>
      </div>
      <div class="form-group">
        <table class="table table-bordered table-sm">
          <tbody>
            <tr>
              <th>Nombre del equipo</th>
              <td>{{ machine.name }}</td>
            </tr>
            <tr>
              <th>Nombre del juego</th>
              <td>{{ machine.game }}</td>
            </tr>
            <tr>
              <th>Denominacion de moneda</th>
              <td>{{ machine.denominate }}</td>
            </tr>
            <tr>
              <th>Fabricante</th>
              <td>{{ machine.maker }}</td>
            </tr>
            <tr>
              <th>Serie</th>
              <td>{{ machine.series }}</td>
            </tr>
            <tr>
              <th>Posicion</th>
              <td>{{ machine.position }}</td>
            </tr>
            <tr>
              <th>Numero de maquina</th>
              <td>{{ machine.number }}</td>
            </tr>
            <tr>
              <th>Observacion</th>
              <td>{{ machine.observation }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="form-group">
        <div class="float-right">
          <button class="btn btn-info mr-2" type="button" @click='$router.go(-1)'>
            Cancelar
            <i data-feather='heart'></i>
          </button>
          <button class="btn btn-danger" type="button" @click='submit()'>
            Eliminar
            <i data-feather='alert-circle'></i>
          </button>
        </div>
      </div>
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
      machine: {},
    }
  },
  methods: {
    fetchData() {
      var machineId = this.$route.params.machineId;
      this.$http.get(`machines/${machineId}`).then(response => {
        this.machine = response.body.machine;
      });
    },
    submit: function() {
      this.$http.delete(`machines/${this.machine.id}`).then(response => {
        this.$router.go(-1);
        this.$root.$emit('message', 'Equipo eliminado correctamente');
      });
    }
  }
}
</script>

<style lang="css">
</style>
