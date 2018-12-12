<template lang="html">
  <div class="row">
    <div class="col">
      <select class="custom-select form-group" v-model='currentRoom'>
        <option :value="{}">Seleccione una sala...</option>
        <option v-for='item in rooms' :value="item">{{ item.name }}</option>
      </select>
      <div class="card text-center">
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
              <router-link class="nav-link" to='/report'>Liquidacion</router-link>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Sala</a>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to='/report/relleno'>Relleno</router-link>
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
                  <a class="btn btn-success btn-block" target="_blank" @click='setLink($event, $event.target)'>Imprimir</a>
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
              <th>POSICION</th>
              <th>RELLENO</th>
              <th>RETIRO</th>
              <th>PAGO MANUAL</th>
            </thead>
            <tbody>
              <tr v-for='(item, index) in operations'>
                <td>{{ item.created_at }}</td>
                <td>{{ item.machine.position }}</td>
                <td v-if='item.type == "0"'>{{ item.cash }}</td>
                <td v-if='item.type == "0"'> - </td>
                <td v-if='item.type == "0"'> - </td>
                <td v-if='item.type == "1"'> - </td>
                <td v-if='item.type == "1"'>{{ item.cash }}</td>
                <td v-if='item.type == "1"'> - </td>
                <td v-if='item.type == "2"'> - </td>
                <td v-if='item.type == "2"'> - </td>
                <td v-if='item.type == "2"'>{{ item.cash }}</td>
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
      sd: '',
      ed: '',
      operations: [],
    }
  },
  methods: {
    fetchData() {
      this.$http.get('rooms').then(response => {
        this.rooms = response.body.rooms;
      });
    },
    setLink(event, el) {
      if (this.sd && this.ed) {
        el.href = `${this.$http.options.root}print/sala/${this.sd}/${this.ed}/${this.currentRoom.id}`;
      } else {
        event.preventDefault();
      }
      console.log(`/print/relleno/${this.sd}/${this.ed}/${this.position}`);
    },
    find() {
      this.$http.get(`operations/byDateRange/${this.sd}/${this.ed}/${this.currentRoom.id}`).then(response => {
        console.log(response);
        this.operations =  response.body.operations;
      }, response => {
        console.log(response);
      });
    },
    updated() {
      this.$nextTick(function () {
        feather.replace();
      })
    }
  }
}
</script>

<style lang="css">
</style>
