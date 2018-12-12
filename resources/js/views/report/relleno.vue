<template lang="html">
  <div class="row">
    <div class="col">
      <select class="custom-select form-group" v-model='currentRoom' @change='setRoom()'>
        <option :value="{}">Seleccione una sala...</option>
        <option v-for='item in rooms' :value="item">{{ item.name }}</option>
      </select>
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <router-link class="nav-link" to="/report">Liquidacion</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to='/report/sala'>Sala</router-link>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Relleno</a>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/report/retiro">Retiro</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/report/pago">Pago Manual</router-link>
            </li>
          </ul>
        </div>
        <div class="card-body" v-if='Object.keys(currentRoom).length'>
          <div class="form-row form-group">
            <label class="col-2 col-form-label" for="">POS. MAQUINA</label>
            <div class="col-4">
              <select class="custom-select" v-model='position'>
                <option value="" disabled selected>Selecion una posicion</option>
                <option :value="item.position" v-for='(item, index) in machines'>{{ item.position }}</option>
              </select>
            </div>
          </div>
          <div class="form-row form-group">
            <label class="col-1 col-form-label">Inicio</label>
            <div class="col-3">
              <div class="input-group">
                <input class="form-control" type="date" v-model='sd'>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i data-feather='calendar' width='18' height='18'></i>
                  </span>
                </div>
              </div>
            </div>
            <label class="col-1 col-form-label">Fin</label>
            <div class="col-3">
              <div class="input-group">
                <input class="form-control" type="date" v-model='ed'>
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i data-feather='calendar' width='18' height='18'></i>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-4">
              <div class="form-row">
                <div class="col-6">
                  <button class="btn btn-info btn-block" type="button" @click='find()'>Filtrar</button>
                </div>
                <div class="col-6">
                  <a class="btn btn-success btn-block" href="" target="_blank" @click='setLink($event, $event.target)'>Imprimir</a>
                </div>
                <!-- <div class="col-4">
                  <button class="btn btn-secondary btn-block" type="button" name="button">Salir</button>
                </div> -->
              </div>
            </div>
          </div>
          <table class="table table-striped trable-bordered table-bordered">
            <thead>
              <th>FECHA REGISTRO</th>
              <th>RELLENO</th>
            </thead>
            <tbody>
              <tr v-for='(item, index) in operations'>
                <td>{{ item.created_at }}</td>
                <td>{{ item.cash }}</td>
              </tr>
            </tbody>
          </table>
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
      currentRoom: {},
      rooms: [],
      operations: [],
      machines: [],
      sd: '',
      ed: '',
      position: '',
    }
  },
  methods: {
    fetchData() {
      this.$http.get('machines').then(response => {
        this.machines = response.body.machines;
        console.log(response);
      }, response => {
        console.log(response);
      });
      this.$http.get('rooms').then(response => {
        this.rooms = response.body.rooms;
      });
    },
    setLink(event, el) {
      if (this.sd && this.ed && this.position) {
        el.href = `${this.$http.options.root}print/relleno/${this.sd}/${this.ed}/${this.position}/${this.currentRoom.id}`;
      } else {
        event.preventDefault();
      }
      console.log(`/print/relleno/${this.sd}/${this.ed}/${this.position}`);
    },
    setRoom() {
      this.$http.get(`rooms/${this.currentRoom.id}/withMachines`).then(response => {
        console.log(response);
        this.machines = response.body.room.machines;
      }, response => {
        console.log(response);
      });
    },
    find() {
      this.$http.get(`operations/byDateRangeAndPosition/${this.sd}/${this.ed}/${this.position}/0/${this.currentRoom.id}`).then(response => {
        console.log(response);
        this.operations = response.body.operations;
      }, response => {
        console.log(response);
      })
    }
  }
}
</script>

<style lang="css">
</style>
